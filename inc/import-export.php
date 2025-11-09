<?php
/**
 * Theme Style Import/Export System
 * Allows users to backup, share, and restore theme customizations
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Import/Export submenu to Appearance
 */
function dthree_add_import_export_page() {
    add_theme_page(
        'Import/Export Styles',
        'Import/Export Styles',
        'manage_options',
        'dthree-import-export',
        'dthree_import_export_page_content'
    );
}
add_action( 'admin_menu', 'dthree_add_import_export_page' );

/**
 * Get all theme customizer settings
 */
function dthree_get_all_theme_settings() {
    $settings = array(
        'theme_name' => 'DThree Gutenberg',
        'theme_version' => DTHREE_VERSION,
        'export_date' => current_time( 'Y-m-d H:i:s' ),
        'site_url' => home_url(),
        'settings' => array(),
        'theme_mods' => get_theme_mods(),
    );
    
    // Get all dthree-related options
    global $wpdb;
    $options = $wpdb->get_results(
        "SELECT option_name, option_value 
        FROM {$wpdb->options} 
        WHERE option_name LIKE 'dthree_%' 
        OR option_name LIKE 'theme_mods_dthree%'"
    );
    
    foreach ( $options as $option ) {
        $settings['settings'][ $option->option_name ] = maybe_unserialize( $option->option_value );
    }
    
    return $settings;
}

/**
 * Export settings to JSON file
 */
function dthree_export_settings() {
    // Verify nonce
    if ( ! isset( $_POST['dthree_export_nonce'] ) || 
         ! wp_verify_nonce( $_POST['dthree_export_nonce'], 'dthree_export' ) ) {
        wp_die( 'Security check failed' );
    }
    
    // Check permissions
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Insufficient permissions' );
    }
    
    $settings = dthree_get_all_theme_settings();
    
    // Add site metadata
    $settings['site_name'] = get_bloginfo( 'name' );
    $settings['export_type'] = isset( $_POST['export_type'] ) ? sanitize_text_field( $_POST['export_type'] ) : 'full';
    
    // Filter settings based on export type
    if ( $settings['export_type'] === 'colors_only' ) {
        $color_settings = array();
        foreach ( $settings['theme_mods'] as $key => $value ) {
            if ( strpos( $key, 'color' ) !== false || strpos( $key, 'background' ) !== false ) {
                $color_settings[ $key ] = $value;
            }
        }
        $settings['theme_mods'] = $color_settings;
    } elseif ( $settings['export_type'] === 'typography_only' ) {
        $typo_settings = array();
        foreach ( $settings['theme_mods'] as $key => $value ) {
            if ( strpos( $key, 'font' ) !== false || 
                 strpos( $key, 'text' ) !== false || 
                 strpos( $key, 'heading' ) !== false ) {
                $typo_settings[ $key ] = $value;
            }
        }
        $settings['theme_mods'] = $typo_settings;
    }
    
    // Generate filename
    $filename = 'dthree-theme-settings-' . date( 'Y-m-d-His' ) . '.json';
    
    // Output JSON file
    header( 'Content-Type: application/json' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    header( 'Pragma: no-cache' );
    echo wp_json_encode( $settings, JSON_PRETTY_PRINT );
    exit;
}

/**
 * Import settings from JSON file
 */
function dthree_import_settings() {
    // Verify nonce
    if ( ! isset( $_POST['dthree_import_nonce'] ) || 
         ! wp_verify_nonce( $_POST['dthree_import_nonce'], 'dthree_import' ) ) {
        return new WP_Error( 'invalid_nonce', 'Security check failed' );
    }
    
    // Check permissions
    if ( ! current_user_can( 'manage_options' ) ) {
        return new WP_Error( 'insufficient_permissions', 'You do not have permission to import settings' );
    }
    
    // Check if file was uploaded
    if ( ! isset( $_FILES['import_file'] ) || $_FILES['import_file']['error'] !== UPLOAD_ERR_OK ) {
        return new WP_Error( 'upload_error', 'File upload failed' );
    }
    
    // Validate file type
    $file_type = wp_check_filetype( $_FILES['import_file']['name'] );
    if ( $file_type['ext'] !== 'json' ) {
        return new WP_Error( 'invalid_file_type', 'Please upload a JSON file' );
    }
    
    // Read file contents
    $file_content = file_get_contents( $_FILES['import_file']['tmp_name'] );
    $settings = json_decode( $file_content, true );
    
    // Validate JSON
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return new WP_Error( 'invalid_json', 'Invalid JSON file: ' . json_last_error_msg() );
    }
    
    // Validate settings structure
    if ( ! isset( $settings['theme_name'] ) || $settings['theme_name'] !== 'DThree Gutenberg' ) {
        return new WP_Error( 'invalid_theme', 'This settings file is not for DThree Gutenberg theme' );
    }
    
    // Backup current settings before import
    dthree_create_settings_backup();
    
    // Import theme mods
    if ( isset( $settings['theme_mods'] ) && is_array( $settings['theme_mods'] ) ) {
        foreach ( $settings['theme_mods'] as $key => $value ) {
            set_theme_mod( $key, $value );
        }
    }
    
    // Import options
    if ( isset( $settings['settings'] ) && is_array( $settings['settings'] ) ) {
        foreach ( $settings['settings'] as $key => $value ) {
            // Skip certain sensitive options
            $skip_options = array( 'siteurl', 'home', 'admin_email' );
            if ( ! in_array( $key, $skip_options, true ) ) {
                update_option( $key, $value );
            }
        }
    }
    
    return true;
}

/**
 * Create backup of current settings
 */
function dthree_create_settings_backup() {
    $settings = dthree_get_all_theme_settings();
    $backup_key = 'dthree_settings_backup_' . time();
    update_option( $backup_key, $settings, false );
    
    // Keep only last 5 backups
    dthree_cleanup_old_backups( 5 );
    
    return $backup_key;
}

/**
 * Cleanup old backup files
 */
function dthree_cleanup_old_backups( $keep = 5 ) {
    global $wpdb;
    
    $backups = $wpdb->get_results(
        "SELECT option_name 
        FROM {$wpdb->options} 
        WHERE option_name LIKE 'dthree_settings_backup_%' 
        ORDER BY option_name DESC"
    );
    
    if ( count( $backups ) > $keep ) {
        $to_delete = array_slice( $backups, $keep );
        foreach ( $to_delete as $backup ) {
            delete_option( $backup->option_name );
        }
    }
}

/**
 * Get list of available backups
 */
function dthree_get_backups_list() {
    global $wpdb;
    
    $backups = $wpdb->get_results(
        "SELECT option_name, option_value 
        FROM {$wpdb->options} 
        WHERE option_name LIKE 'dthree_settings_backup_%' 
        ORDER BY option_name DESC"
    );
    
    $backup_list = array();
    foreach ( $backups as $backup ) {
        $data = maybe_unserialize( $backup->option_value );
        $timestamp = str_replace( 'dthree_settings_backup_', '', $backup->option_name );
        
        $backup_list[] = array(
            'key' => $backup->option_name,
            'date' => isset( $data['export_date'] ) ? $data['export_date'] : date( 'Y-m-d H:i:s', $timestamp ),
            'site_name' => isset( $data['site_name'] ) ? $data['site_name'] : 'Unknown',
        );
    }
    
    return $backup_list;
}

/**
 * Restore from backup
 */
function dthree_restore_from_backup() {
    // Verify nonce
    if ( ! isset( $_POST['dthree_restore_nonce'] ) || 
         ! wp_verify_nonce( $_POST['dthree_restore_nonce'], 'dthree_restore' ) ) {
        return new WP_Error( 'invalid_nonce', 'Security check failed' );
    }
    
    // Check permissions
    if ( ! current_user_can( 'manage_options' ) ) {
        return new WP_Error( 'insufficient_permissions', 'You do not have permission to restore settings' );
    }
    
    $backup_key = isset( $_POST['backup_key'] ) ? sanitize_text_field( $_POST['backup_key'] ) : '';
    
    if ( empty( $backup_key ) ) {
        return new WP_Error( 'invalid_backup', 'Invalid backup selected' );
    }
    
    $settings = get_option( $backup_key );
    
    if ( ! $settings ) {
        return new WP_Error( 'backup_not_found', 'Backup not found' );
    }
    
    // Create new backup before restoring
    dthree_create_settings_backup();
    
    // Restore theme mods
    if ( isset( $settings['theme_mods'] ) && is_array( $settings['theme_mods'] ) ) {
        foreach ( $settings['theme_mods'] as $key => $value ) {
            set_theme_mod( $key, $value );
        }
    }
    
    // Restore options
    if ( isset( $settings['settings'] ) && is_array( $settings['settings'] ) ) {
        foreach ( $settings['settings'] as $key => $value ) {
            update_option( $key, $value );
        }
    }
    
    return true;
}

/**
 * Import/Export page content
 */
function dthree_import_export_page_content() {
    // Handle form submissions
    $message = '';
    $error = '';
    
    if ( isset( $_POST['export_settings'] ) ) {
        dthree_export_settings();
    }
    
    if ( isset( $_POST['import_settings'] ) ) {
        $result = dthree_import_settings();
        if ( is_wp_error( $result ) ) {
            $error = $result->get_error_message();
        } else {
            $message = 'Settings imported successfully!';
        }
    }
    
    if ( isset( $_POST['restore_backup'] ) ) {
        $result = dthree_restore_from_backup();
        if ( is_wp_error( $result ) ) {
            $error = $result->get_error_message();
        } else {
            $message = 'Settings restored successfully from backup!';
        }
    }
    
    if ( isset( $_POST['create_backup'] ) ) {
        if ( isset( $_POST['dthree_backup_nonce'] ) && 
             wp_verify_nonce( $_POST['dthree_backup_nonce'], 'dthree_backup' ) ) {
            $backup_key = dthree_create_settings_backup();
            $message = 'Backup created successfully!';
        }
    }
    
    $backups = dthree_get_backups_list();
    ?>
    <div class="wrap">
        <h1>Import/Export Theme Styles</h1>
        <p class="description">Backup, share, and restore your theme customizations including colors, fonts, and layout settings.</p>
        
        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php echo esc_html( $message ); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if ( $error ) : ?>
            <div class="notice notice-error is-dismissible">
                <p><?php echo esc_html( $error ); ?></p>
            </div>
        <?php endif; ?>
        
        <div class="dthree-import-export-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin-top: 20px;">
            
            <!-- Export Settings -->
            <div class="card">
                <h2 class="title">📤 Export Settings</h2>
                <p>Download your current theme settings as a JSON file.</p>
                
                <form method="post" action="">
                    <?php wp_nonce_field( 'dthree_export', 'dthree_export_nonce' ); ?>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row">Export Type</th>
                            <td>
                                <label>
                                    <input type="radio" name="export_type" value="full" checked>
                                    <strong>Full Export</strong> - All settings
                                </label><br>
                                <label>
                                    <input type="radio" name="export_type" value="colors_only">
                                    <strong>Colors Only</strong> - Color scheme only
                                </label><br>
                                <label>
                                    <input type="radio" name="export_type" value="typography_only">
                                    <strong>Typography Only</strong> - Fonts and text settings
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <p>
                        <input type="submit" name="export_settings" class="button button-primary" value="Export Settings">
                    </p>
                    
                    <p class="description">
                        💡 <strong>Tip:</strong> Save this file to use as a backup or to apply these settings to another site.
                    </p>
                </form>
            </div>
            
            <!-- Import Settings -->
            <div class="card">
                <h2 class="title">📥 Import Settings</h2>
                <p>Upload a previously exported JSON file to restore settings.</p>
                
                <form method="post" action="" enctype="multipart/form-data">
                    <?php wp_nonce_field( 'dthree_import', 'dthree_import_nonce' ); ?>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row">Settings File</th>
                            <td>
                                <input type="file" name="import_file" accept=".json" required>
                                <p class="description">Select a JSON file exported from DThree Gutenberg theme.</p>
                            </td>
                        </tr>
                    </table>
                    
                    <p>
                        <input type="submit" name="import_settings" class="button button-primary" value="Import Settings">
                    </p>
                    
                    <p class="description">
                        ⚠️ <strong>Warning:</strong> Importing will overwrite your current settings. A backup will be created automatically.
                    </p>
                </form>
            </div>
            
            <!-- Create Backup -->
            <div class="card">
                <h2 class="title">💾 Create Backup</h2>
                <p>Save a snapshot of your current settings for quick restoration.</p>
                
                <form method="post" action="">
                    <?php wp_nonce_field( 'dthree_backup', 'dthree_backup_nonce' ); ?>
                    
                    <p>
                        <input type="submit" name="create_backup" class="button button-secondary" value="Create Backup Now">
                    </p>
                    
                    <p class="description">
                        💡 <strong>Tip:</strong> Create a backup before making major changes to your theme settings.
                    </p>
                </form>
            </div>
            
            <!-- Restore from Backup -->
            <div class="card">
                <h2 class="title">♻️ Restore from Backup</h2>
                <p>Restore your theme settings from a previous backup.</p>
                
                <?php if ( ! empty( $backups ) ) : ?>
                    <form method="post" action="">
                        <?php wp_nonce_field( 'dthree_restore', 'dthree_restore_nonce' ); ?>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">Select Backup</th>
                                <td>
                                    <select name="backup_key" class="regular-text" required>
                                        <option value="">-- Select a backup --</option>
                                        <?php foreach ( $backups as $backup ) : ?>
                                            <option value="<?php echo esc_attr( $backup['key'] ); ?>">
                                                <?php echo esc_html( $backup['date'] ); ?>
                                                <?php if ( $backup['site_name'] !== 'Unknown' ) : ?>
                                                    - <?php echo esc_html( $backup['site_name'] ); ?>
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="description">
                                        Found <?php echo count( $backups ); ?> backup(s). Showing most recent 5.
                                    </p>
                                </td>
                            </tr>
                        </table>
                        
                        <p>
                            <input type="submit" name="restore_backup" class="button button-secondary" value="Restore Selected Backup">
                        </p>
                        
                        <p class="description">
                            ⚠️ <strong>Warning:</strong> Restoring will overwrite your current settings. A new backup will be created automatically.
                        </p>
                    </form>
                <?php else : ?>
                    <p><em>No backups found. Create your first backup above.</em></p>
                <?php endif; ?>
            </div>
            
        </div>
        
        <!-- Style Presets -->
        <div class="card" style="margin-top: 20px;">
            <h2 class="title">🎨 Ready-Made Style Presets</h2>
            <p>Quick-start with professionally designed color schemes and typography combinations.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px;">
                
                <!-- Dthree Digital Preset -->
                <div class="preset-card" style="border: 2px solid #2563eb; border-radius: 8px; padding: 15px; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white;">
                    <h3 style="margin-top: 0; color: white;">Dthree Digital</h3>
                    <div style="display: flex; gap: 5px; margin: 10px 0;">
                        <span style="width: 30px; height: 30px; background: #2563eb; border-radius: 50%; border: 2px solid white;"></span>
                        <span style="width: 30px; height: 30px; background: #1e40af; border-radius: 50%; border: 2px solid white;"></span>
                        <span style="width: 30px; height: 30px; background: #3b82f6; border-radius: 50%; border: 2px solid white;"></span>
                        <span style="width: 30px; height: 30px; background: #1f2937; border-radius: 50%; border: 2px solid white;"></span>
                    </div>
                    <p style="font-size: 13px; opacity: 0.9; margin-bottom: 15px;">Modern blue palette with professional typography</p>
                    <button class="button button-secondary" onclick="alert('This is the default theme style. Already active!')">Default Style</button>
                </div>
                
                <!-- Corporate Blue Preset -->
                <div class="preset-card" style="border: 2px solid #0284c7; border-radius: 8px; padding: 15px; background: #f0f9ff;">
                    <h3 style="margin-top: 0;">Corporate Blue</h3>
                    <div style="display: flex; gap: 5px; margin: 10px 0;">
                        <span style="width: 30px; height: 30px; background: #0284c7; border-radius: 50%; border: 2px solid #0284c7;"></span>
                        <span style="width: 30px; height: 30px; background: #0369a1; border-radius: 50%; border: 2px solid #0284c7;"></span>
                        <span style="width: 30px; height: 30px; background: #38bdf8; border-radius: 50%; border: 2px solid #0284c7;"></span>
                        <span style="width: 30px; height: 30px; background: #1e293b; border-radius: 50%; border: 2px solid #0284c7;"></span>
                    </div>
                    <p style="font-size: 13px; margin-bottom: 15px;">Trust-building cyan blues for corporate sites</p>
                    <button class="button" disabled>Coming Soon</button>
                </div>
                
                <!-- Tech Startup Preset -->
                <div class="preset-card" style="border: 2px solid #7c3aed; border-radius: 8px; padding: 15px; background: #faf5ff;">
                    <h3 style="margin-top: 0;">Tech Startup</h3>
                    <div style="display: flex; gap: 5px; margin: 10px 0;">
                        <span style="width: 30px; height: 30px; background: #7c3aed; border-radius: 50%; border: 2px solid #7c3aed;"></span>
                        <span style="width: 30px; height: 30px; background: #6d28d9; border-radius: 50%; border: 2px solid #7c3aed;"></span>
                        <span style="width: 30px; height: 30px; background: #a78bfa; border-radius: 50%; border: 2px solid #7c3aed;"></span>
                        <span style="width: 30px; height: 30px; background: #1f2937; border-radius: 50%; border: 2px solid #7c3aed;"></span>
                    </div>
                    <p style="font-size: 13px; margin-bottom: 15px;">Bold purples for innovative tech companies</p>
                    <button class="button" disabled>Coming Soon</button>
                </div>
                
                <!-- Creative Agency Preset -->
                <div class="preset-card" style="border: 2px solid #ec4899; border-radius: 8px; padding: 15px; background: #fdf2f8;">
                    <h3 style="margin-top: 0;">Creative Agency</h3>
                    <div style="display: flex; gap: 5px; margin: 10px 0;">
                        <span style="width: 30px; height: 30px; background: #ec4899; border-radius: 50%; border: 2px solid #ec4899;"></span>
                        <span style="width: 30px; height: 30px; background: #db2777; border-radius: 50%; border: 2px solid #ec4899;"></span>
                        <span style="width: 30px; height: 30px; background: #f472b6; border-radius: 50%; border: 2px solid #ec4899;"></span>
                        <span style="width: 30px; height: 30px; background: #1f2937; border-radius: 50%; border: 2px solid #ec4899;"></span>
                    </div>
                    <p style="font-size: 13px; margin-bottom: 15px;">Vibrant pink palette for creative studios</p>
                    <button class="button" disabled>Coming Soon</button>
                </div>
                
            </div>
            
            <p style="margin-top: 20px;">
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
                    Customize Colors & Fonts →
                </a>
            </p>
        </div>
        
        <!-- Usage Guide -->
        <div class="card" style="margin-top: 20px;">
            <h2>📖 How to Use Import/Export</h2>
            
            <h3>🔄 Backup & Restore Workflow</h3>
            <ol>
                <li><strong>Before Changes:</strong> Create a backup before making major customization changes</li>
                <li><strong>Make Changes:</strong> Customize your theme through Appearance → Customize</li>
                <li><strong>If Needed:</strong> Restore from backup to undo all changes at once</li>
            </ol>
            
            <h3>🌐 Share Between Sites</h3>
            <ol>
                <li><strong>Source Site:</strong> Export settings as JSON file (Full Export)</li>
                <li><strong>Download:</strong> Save the file to your computer</li>
                <li><strong>Target Site:</strong> Go to Import/Export on the new site</li>
                <li><strong>Upload:</strong> Import the JSON file to apply settings</li>
            </ol>
            
            <h3>🎨 Partial Style Imports</h3>
            <ul>
                <li><strong>Colors Only:</strong> Export just color scheme to reuse palette</li>
                <li><strong>Typography Only:</strong> Export fonts and text settings separately</li>
                <li><strong>Mix & Match:</strong> Import colors from one site, typography from another</li>
            </ul>
            
            <h3>💾 What Gets Saved</h3>
            <ul>
                <li>✅ Color schemes (primary, secondary, text, background)</li>
                <li>✅ Typography (font families, sizes, line heights)</li>
                <li>✅ Layout settings (widths, spacing, header/footer styles)</li>
                <li>✅ Business info (tagline, contact details)</li>
                <li>✅ Social media links</li>
                <li>✅ SEO and AI feature preferences</li>
                <li>❌ Content (pages, posts, media)</li>
                <li>❌ Menus and widgets</li>
                <li>❌ User accounts and passwords</li>
            </ul>
            
            <h3>⚠️ Important Notes</h3>
            <ul>
                <li>Always test imports on staging sites first</li>
                <li>Backups are stored in your database (cleaned automatically)</li>
                <li>Only last 5 backups are kept to save space</li>
                <li>Settings files only work with DThree Gutenberg theme</li>
                <li>Sensitive data (admin email, site URLs) are not imported</li>
            </ul>
        </div>
        
    </div>
    
    <style>
        .dthree-import-export-grid .card {
            padding: 20px;
        }
        .dthree-import-export-grid .card h2.title {
            margin-top: 0;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .dthree-import-export-grid .form-table th {
            padding-left: 0;
        }
        .preset-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .preset-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
    <?php
}

/**
 * Add quick link to admin bar
 */
function dthree_add_admin_bar_import_export( $wp_admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    $wp_admin_bar->add_node( array(
        'id'     => 'dthree-import-export',
        'parent' => 'appearance',
        'title'  => 'Import/Export Styles',
        'href'   => admin_url( 'themes.php?page=dthree-import-export' ),
    ) );
}
add_action( 'admin_bar_menu', 'dthree_add_admin_bar_import_export', 999 );

/**
 * Add action links to theme page
 */
function dthree_theme_action_links( $actions ) {
    $import_export_link = array(
        'import_export' => '<a href="' . admin_url( 'themes.php?page=dthree-import-export' ) . '">Import/Export</a>',
    );
    return array_merge( $import_export_link, $actions );
}
add_filter( 'theme_action_links_dthree-gutenberg', 'dthree_theme_action_links' );