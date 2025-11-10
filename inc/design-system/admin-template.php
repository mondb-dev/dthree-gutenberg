<?php
/**
 * Design System Admin Template
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Handle form submission
if ( isset( $_POST['submit'] ) && check_admin_referer( 'dthree_design_system_save', 'dthree_design_system_nonce' ) ) {
    $posted_settings = $_POST['dthree_design_system'] ?? array();
    $instance = DThree_Design_System::get_instance();
    $instance->save_settings( $posted_settings );
    echo '<div class="notice notice-success"><p>' . __( 'Design System settings saved!', 'dthree-gutenberg' ) . '</p></div>';
    $settings = $instance->get_settings(); // Refresh settings
}
?>

<div class="wrap dthree-design-system-admin">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-admin-customizer"></span>
        <?php echo esc_html__( 'Design System', 'dthree-gutenberg' ); ?>
    </h1>
    
    <p class="description">
        <?php echo esc_html__( 'Create and manage your website\'s design system with components, typography, colors, and micro-interactions.', 'dthree-gutenberg' ); ?>
    </p>

    <div class="dthree-design-system-header">
        <div class="dthree-actions">
            <button type="button" class="button button-secondary" id="dthree-import-btn">
                <span class="dashicons dashicons-upload"></span>
                <?php esc_html_e( 'Import Design System', 'dthree-gutenberg' ); ?>
            </button>
            
            <button type="button" class="button button-secondary" id="dthree-export-btn">
                <span class="dashicons dashicons-download"></span>
                <?php esc_html_e( 'Export Design System', 'dthree-gutenberg' ); ?>
            </button>
            
            <button type="button" class="button button-primary" id="dthree-build-assets">
                <span class="dashicons dashicons-hammer"></span>
                <?php esc_html_e( 'Build Assets', 'dthree-gutenberg' ); ?>
            </button>
        </div>
    </div>

    <div class="dthree-admin-container">
        <div class="dthree-admin-main">
            <form method="post" action="">
                <?php wp_nonce_field( 'dthree_design_system_save', 'dthree_design_system_nonce' ); ?>
                
                <div class="dthree-tabs">
                    <nav class="nav-tab-wrapper">
                        <a href="#colors" class="nav-tab nav-tab-active" data-tab="colors">
                            <span class="dashicons dashicons-art"></span>
                            <?php esc_html_e( 'Colors', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#typography" class="nav-tab" data-tab="typography">
                            <span class="dashicons dashicons-editor-textcolor"></span>
                            <?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#spacing" class="nav-tab" data-tab="spacing">
                            <span class="dashicons dashicons-grid-view"></span>
                            <?php esc_html_e( 'Spacing', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#components" class="nav-tab" data-tab="components">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <?php esc_html_e( 'Components', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#sections" class="nav-tab" data-tab="sections">
                            <span class="dashicons dashicons-layout"></span>
                            <?php esc_html_e( 'Section Layouts', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#menus" class="nav-tab" data-tab="menus">
                            <span class="dashicons dashicons-menu-alt3"></span>
                            <?php esc_html_e( 'Menu Builder', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#animations" class="nav-tab" data-tab="animations">
                            <span class="dashicons dashicons-controls-play"></span>
                            <?php esc_html_e( 'Micro-interactions', 'dthree-gutenberg' ); ?>
                        </a>
                        <a href="#responsive" class="nav-tab" data-tab="responsive">
                            <span class="dashicons dashicons-smartphone"></span>
                            <?php esc_html_e( 'Responsive', 'dthree-gutenberg' ); ?>
                        </a>
                    </nav>

                    <!-- Colors Tab -->
                    <div class="tab-content active" id="colors">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Color Palette', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define your brand colors and theme palette.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-color-grid">
                                <?php foreach ( $settings['colors'] as $color_key => $color_value ) : ?>
                                <div class="dthree-color-item">
                                    <label for="color_<?php echo esc_attr( $color_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $color_key ) ) ); ?>
                                    </label>
                                    <div class="color-input-wrapper">
                                        <input type="text" 
                                               id="color_<?php echo esc_attr( $color_key ); ?>"
                                               name="dthree_design_system[colors][<?php echo esc_attr( $color_key ); ?>]" 
                                               value="<?php echo esc_attr( $color_value ); ?>" 
                                               class="color-picker" />
                                        <div class="color-preview" style="background-color: <?php echo esc_attr( $color_value ); ?>"></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Typography Tab -->
                    <div class="tab-content" id="typography">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure font families, sizes, and spacing for consistent typography.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-typography-controls">
                                <h3><?php esc_html_e( 'Font Families', 'dthree-gutenberg' ); ?></h3>
                                
                                <!-- Primary Font -->
                                <div class="font-family-group">
                                    <h4><?php esc_html_e( 'Primary Font', 'dthree-gutenberg' ); ?></h4>
                                    
                                    <label><?php esc_html_e( 'Font Source', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-source-selector">
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_primary][source]" value="system" 
                                                   <?php checked( $settings['typography']['font_family_primary']['source'] ?? 'google', 'system' ); ?> />
                                            <?php esc_html_e( 'System Font', 'dthree-gutenberg' ); ?>
                                        </label>
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_primary][source]" value="google" 
                                                   <?php checked( $settings['typography']['font_family_primary']['source'] ?? 'google', 'google' ); ?> />
                                            <?php esc_html_e( 'Google Fonts', 'dthree-gutenberg' ); ?>
                                        </label>
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_primary][source]" value="custom" 
                                                   <?php checked( $settings['typography']['font_family_primary']['source'] ?? 'google', 'custom' ); ?> />
                                            <?php esc_html_e( 'Custom Upload', 'dthree-gutenberg' ); ?>
                                        </label>
                                    </div>
                                    
                                    <label><?php esc_html_e( 'Font Family', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-family-input-group">
                                        <input type="text" 
                                               name="dthree_design_system[typography][font_family_primary][family]"
                                               value="<?php echo esc_attr( $settings['typography']['font_family_primary']['family'] ); ?>"
                                               placeholder="Inter" 
                                               class="font-family-input" />
                                        <button type="button" class="button google-font-search" data-target="font_family_primary">
                                            <?php esc_html_e( 'Browse Google Fonts', 'dthree-gutenberg' ); ?>
                                        </button>
                                        <button type="button" class="button custom-font-upload" data-target="font_family_primary">
                                            <?php esc_html_e( 'Upload Custom Font', 'dthree-gutenberg' ); ?>
                                        </button>
                                    </div>
                                    
                                    <label><?php esc_html_e( 'Fallbacks', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_primary][fallbacks]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_primary']['fallbacks'] ); ?>"
                                           placeholder="system-ui, -apple-system, sans-serif" />
                                    
                                    <label><?php esc_html_e( 'Font Weights', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-weights-selector">
                                        <?php
                                        $weights = array( 100, 200, 300, 400, 500, 600, 700, 800, 900 );
                                        $selected_weights = $settings['typography']['font_family_primary']['weights'] ?? array( 400, 700 );
                                        foreach ( $weights as $weight ) :
                                        ?>
                                        <label class="weight-checkbox">
                                            <input type="checkbox" 
                                                   name="dthree_design_system[typography][font_family_primary][weights][]" 
                                                   value="<?php echo esc_attr( $weight ); ?>"
                                                   <?php checked( in_array( $weight, $selected_weights ) ); ?> />
                                            <?php echo esc_html( $weight ); ?>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Secondary Font -->
                                <div class="font-family-group">
                                    <h4><?php esc_html_e( 'Secondary Font', 'dthree-gutenberg' ); ?></h4>
                                    
                                    <label><?php esc_html_e( 'Font Source', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-source-selector">
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_secondary][source]" value="system" 
                                                   <?php checked( $settings['typography']['font_family_secondary']['source'] ?? 'system', 'system' ); ?> />
                                            <?php esc_html_e( 'System Font', 'dthree-gutenberg' ); ?>
                                        </label>
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_secondary][source]" value="google" 
                                                   <?php checked( $settings['typography']['font_family_secondary']['source'] ?? 'system', 'google' ); ?> />
                                            <?php esc_html_e( 'Google Fonts', 'dthree-gutenberg' ); ?>
                                        </label>
                                        <label>
                                            <input type="radio" name="dthree_design_system[typography][font_family_secondary][source]" value="custom" 
                                                   <?php checked( $settings['typography']['font_family_secondary'][' source'] ?? 'system', 'custom' ); ?> />
                                            <?php esc_html_e( 'Custom Upload', 'dthree-gutenberg' ); ?>
                                        </label>
                                    </div>
                                    
                                    <label><?php esc_html_e( 'Font Family', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-family-input-group">
                                        <input type="text" 
                                               name="dthree_design_system[typography][font_family_secondary][family]"
                                               value="<?php echo esc_attr( $settings['typography']['font_family_secondary']['family'] ); ?>"
                                               placeholder="Georgia" 
                                               class="font-family-input" />
                                        <button type="button" class="button google-font-search" data-target="font_family_secondary">
                                            <?php esc_html_e( 'Browse Google Fonts', 'dthree-gutenberg' ); ?>
                                        </button>
                                        <button type="button" class="button custom-font-upload" data-target="font_family_secondary">
                                            <?php esc_html_e( 'Upload Custom Font', 'dthree-gutenberg' ); ?>
                                        </button>
                                    </div>
                                    
                                    <label><?php esc_html_e( 'Fallbacks', 'dthree-gutenberg' ); ?></label>
                                    <input type="text" 
                                           name="dthree_design_system[typography][font_family_secondary][fallbacks]"
                                           value="<?php echo esc_attr( $settings['typography']['font_family_secondary']['fallbacks'] ); ?>"
                                           placeholder="serif" />
                                    
                                    <label><?php esc_html_e( 'Font Weights', 'dthree-gutenberg' ); ?></label>
                                    <div class="font-weights-selector">
                                        <?php
                                        $secondary_weights = $settings['typography']['font_family_secondary']['weights'] ?? array( 400, 700 );
                                        foreach ( $weights as $weight ) :
                                        ?>
                                        <label class="weight-checkbox">
                                            <input type="checkbox" 
                                                   name="dthree_design_system[typography][font_family_secondary][weights][]" 
                                                   value="<?php echo esc_attr( $weight ); ?>"
                                                   <?php checked( in_array( $weight, $secondary_weights ) ); ?> />
                                            <?php echo esc_html( $weight ); ?>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <h3><?php esc_html_e( 'Font Sizes', 'dthree-gutenberg' ); ?></h3>
                                <div class="dthree-size-grid">
                                    <?php foreach ( $settings['typography']['font_sizes'] as $size_key => $size_value ) : ?>
                                    <div class="size-item">
                                        <label for="font_size_<?php echo esc_attr( $size_key ); ?>">
                                            <?php echo esc_html( strtoupper( $size_key ) ); ?>
                                        </label>
                                        <input type="text" 
                                               id="font_size_<?php echo esc_attr( $size_key ); ?>"
                                               name="dthree_design_system[typography][font_sizes][<?php echo esc_attr( $size_key ); ?>]" 
                                               value="<?php echo esc_attr( $size_value ); ?>" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <h3><?php esc_html_e( 'Line Heights', 'dthree-gutenberg' ); ?></h3>
                                <div class="dthree-size-grid">
                                    <?php foreach ( $settings['typography']['line_heights'] as $height_key => $height_value ) : ?>
                                    <div class="size-item">
                                        <label for="line_height_<?php echo esc_attr( $height_key ); ?>">
                                            <?php echo esc_html( ucfirst( $height_key ) ); ?>
                                        </label>
                                        <input type="text" 
                                               id="line_height_<?php echo esc_attr( $height_key ); ?>"
                                               name="dthree_design_system[typography][line_heights][<?php echo esc_attr( $height_key ); ?>]" 
                                               value="<?php echo esc_attr( $height_value ); ?>" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Fonts Modal -->
                    <div id="google-fonts-modal" class="dthree-modal" style="display: none;">
                        <div class="dthree-modal-content">
                            <div class="dthree-modal-header">
                                <h3><?php esc_html_e( 'Browse Google Fonts', 'dthree-gutenberg' ); ?></h3>
                                <button type="button" class="dthree-modal-close">&times;</button>
                            </div>
                            <div class="dthree-modal-body">
                                <input type="text" id="google-fonts-search" placeholder="<?php esc_attr_e( 'Search fonts...', 'dthree-gutenberg' ); ?>" />
                                <div id="google-fonts-list" class="fonts-grid"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Font Upload Modal -->
                    <div id="custom-font-modal" class="dthree-modal" style="display: none;">
                        <div class="dthree-modal-content">
                            <div class="dthree-modal-header">
                                <h3><?php esc_html_e( 'Upload Custom Font', 'dthree-gutenberg' ); ?></h3>
                                <button type="button" class="dthree-modal-close">&times;</button>
                            </div>
                            <div class="dthree-modal-body">
                                <p class="description"><?php esc_html_e( 'Upload font files in .woff, .woff2, .ttf, .otf, or .eot format.', 'dthree-gutenberg' ); ?></p>
                                <label><?php esc_html_e( 'Font Name', 'dthree-gutenberg' ); ?></label>
                                <input type="text" id="custom-font-name" placeholder="<?php esc_attr_e( 'My Custom Font', 'dthree-gutenberg' ); ?>" />
                                
                                <label><?php esc_html_e( 'Upload Font Files', 'dthree-gutenberg' ); ?></label>
                                <input type="file" id="custom-font-file" accept=".woff,.woff2,.ttf,.otf,.eot" multiple />
                                
                                <div id="custom-font-files-list"></div>
                                
                                <button type="button" class="button button-primary" id="upload-font-btn">
                                    <?php esc_html_e( 'Upload Font', 'dthree-gutenberg' ); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Spacing Tab -->
                    <div class="tab-content" id="spacing">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Spacing & Layout', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define consistent spacing, border radius, and shadow values.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Spacing Scale', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['spacing']['scale'] as $space_key => $space_value ) : ?>
                                <div class="size-item">
                                    <label for="spacing_<?php echo esc_attr( $space_key ); ?>">
                                        <?php echo esc_html( strtoupper( $space_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="spacing_<?php echo esc_attr( $space_key ); ?>"
                                           name="dthree_design_system[spacing][scale][<?php echo esc_attr( $space_key ); ?>]" 
                                           value="<?php echo esc_attr( $space_value ); ?>" />
                                    <div class="spacing-preview" style="width: <?php echo esc_attr( $space_value ); ?>; height: <?php echo esc_attr( $space_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Border Radius', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['border_radius'] as $radius_key => $radius_value ) : ?>
                                <div class="size-item">
                                    <label for="border_radius_<?php echo esc_attr( $radius_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $radius_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="border_radius_<?php echo esc_attr( $radius_key ); ?>"
                                           name="dthree_design_system[border_radius][<?php echo esc_attr( $radius_key ); ?>]" 
                                           value="<?php echo esc_attr( $radius_value ); ?>" />
                                    <div class="radius-preview" style="border-radius: <?php echo esc_attr( $radius_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Shadows', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-shadow-grid">
                                <?php foreach ( $settings['shadows'] as $shadow_key => $shadow_value ) : ?>
                                <div class="shadow-item">
                                    <label for="shadow_<?php echo esc_attr( $shadow_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $shadow_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="shadow_<?php echo esc_attr( $shadow_key ); ?>"
                                           name="dthree_design_system[shadows][<?php echo esc_attr( $shadow_key ); ?>]" 
                                           value="<?php echo esc_attr( $shadow_value ); ?>" />
                                    <div class="shadow-preview" style="box-shadow: <?php echo esc_attr( $shadow_value ); ?>;"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Components Tab -->
                    <div class="tab-content" id="components">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Component Library', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure button styles and other component variations with full state control.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Button Variations', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-component-builder">
                                <?php foreach ( $settings['buttons'] as $button_key => $button_settings ) : ?>
                                <div class="component-variation">
                                    <h4><?php echo esc_html( ucfirst( $button_key ) . ' Button' ); ?></h4>
                                    
                                    <div class="button-state-tabs">
                                        <button type="button" class="state-tab active" data-state="default">Default</button>
                                        <button type="button" class="state-tab" data-state="hover">Hover</button>
                                        <button type="button" class="state-tab" data-state="active">Active</button>
                                        <button type="button" class="state-tab" data-state="focus">Focus</button>
                                        <button type="button" class="state-tab" data-state="disabled">Disabled</button>
                                    </div>
                                    
                                    <div class="component-controls">
                                        <!-- Default State -->
                                        <div class="state-controls active" data-state="default">
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Background Color', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][background]" value="<?php echo esc_attr( $button_settings['background'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Text Color', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][color]" value="<?php echo esc_attr( $button_settings['color'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Border', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][border]" value="<?php echo esc_attr( $button_settings['border'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Text Transform', 'dthree-gutenberg' ); ?></label>
                                                <select name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][text_transform]">
                                                    <option value="none" <?php selected( $button_settings['text_transform'] ?? 'none', 'none' ); ?>><?php esc_html_e( 'Normal', 'dthree-gutenberg' ); ?></option>
                                                    <option value="uppercase" <?php selected( $button_settings['text_transform'] ?? 'none', 'uppercase' ); ?>><?php esc_html_e( 'UPPERCASE', 'dthree-gutenberg' ); ?></option>
                                                    <option value="lowercase" <?php selected( $button_settings['text_transform'] ?? 'none', 'lowercase' ); ?>><?php esc_html_e( 'lowercase', 'dthree-gutenberg' ); ?></option>
                                                    <option value="capitalize" <?php selected( $button_settings['text_transform'] ?? 'none', 'capitalize' ); ?>><?php esc_html_e( 'Capitalize', 'dthree-gutenberg' ); ?></option>
                                                </select>
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Font Weight', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][font_weight]" value="<?php echo esc_attr( $button_settings['font_weight'] ?? '500' ); ?>" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Padding', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][padding]" value="<?php echo esc_attr( $button_settings['padding'] ?? '' ); ?>" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Border Radius', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][border_radius]" value="<?php echo esc_attr( $button_settings['border_radius'] ?? '' ); ?>" />
                                            </div>
                                        </div>
                                        
                                        <!-- Hover State -->
                                        <div class="state-controls" data-state="hover">
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Hover Background', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][hover_background]" value="<?php echo esc_attr( $button_settings['hover_background'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Hover Text Color', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][hover_color]" value="<?php echo esc_attr( $button_settings['hover_color'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Hover Border', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][hover_border]" value="<?php echo esc_attr( $button_settings['hover_border'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Hover Transform', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][hover_transform]" value="<?php echo esc_attr( $button_settings['hover_transform'] ?? '' ); ?>" placeholder="translateY(-1px)" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Hover Shadow', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][hover_shadow]" value="<?php echo esc_attr( $button_settings['hover_shadow'] ?? '' ); ?>" placeholder="0 4px 6px rgba(0,0,0,0.1)" />
                                            </div>
                                        </div>
                                        
                                        <!-- Active State -->
                                        <div class="state-controls" data-state="active">
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Active Background', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][active_background]" value="<?php echo esc_attr( $button_settings['active_background'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Active Text Color', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][active_color]" value="<?php echo esc_attr( $button_settings['active_color'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Active Border', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][active_border]" value="<?php echo esc_attr( $button_settings['active_border'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                        </div>
                                        
                                        <!-- Focus State -->
                                        <div class="state-controls" data-state="focus">
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Focus Outline', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][focus_outline]" value="<?php echo esc_attr( $button_settings['focus_outline'] ?? '' ); ?>" placeholder="0 0 0 0.25rem rgba(13,110,253,0.25)" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Focus Border', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][focus_border]" value="<?php echo esc_attr( $button_settings['focus_border'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                        </div>
                                        
                                        <!-- Disabled State -->
                                        <div class="state-controls" data-state="disabled">
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Disabled Background', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][disabled_background]" value="<?php echo esc_attr( $button_settings['disabled_background'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Disabled Text Color', 'dthree-gutenberg' ); ?></label>
                                                <input type="text" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][disabled_color]" value="<?php echo esc_attr( $button_settings['disabled_color'] ?? '' ); ?>" class="color-picker" />
                                            </div>
                                            <div class="control-group">
                                                <label><?php esc_html_e( 'Disabled Opacity', 'dthree-gutenberg' ); ?></label>
                                                <input type="number" step="0.1" min="0" max="1" name="dthree_design_system[buttons][<?php echo esc_attr( $button_key ); ?>][disabled_opacity]" value="<?php echo esc_attr( $button_settings['disabled_opacity'] ?? '0.65' ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="component-preview">
                                        <button type="button" class="btn-preview btn-<?php echo esc_attr( $button_key ); ?>">
                                            <?php echo esc_html( ucfirst( $button_key ) . ' Button' ); ?>
                                        </button>
                                        <button type="button" class="btn-preview btn-<?php echo esc_attr( $button_key ); ?>" disabled>
                                            <?php echo esc_html_e( 'Disabled', 'dthree-gutenberg' ); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Section Layouts Tab -->
                    <div class="tab-content" id="sections">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Section Layout Styling', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Customize the styling for different section container types. All section types are available in Gutenberg blocks.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Container Widths', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'Define max-width values for different container types.', 'dthree-gutenberg' ); ?></p>
                                <div class="container-width-settings">
                                    <?php foreach ( $settings['section_layouts']['container_types'] as $type_key => $container_type ) : ?>
                                    <div class="setting-group">
                                        <label><?php echo esc_html( $container_type['label'] ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[section_layouts][container_types][<?php echo esc_attr( $type_key ); ?>][max_width]"
                                               value="<?php echo esc_attr( $container_type['max_width'] ); ?>"
                                               placeholder="<?php echo esc_attr( $container_type['max_width'] ); ?>">
                                        <small class="description"><?php echo esc_html( $container_type['description'] ); ?></small>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Section Padding', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'Default padding for different section styles.', 'dthree-gutenberg' ); ?></p>
                                <div class="section-padding-settings">
                                    <?php foreach ( $settings['section_layouts']['section_styles'] as $style_key => $section_style ) : ?>
                                    <div class="setting-group">
                                        <label><?php echo esc_html( $section_style['label'] ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[section_layouts][section_styles][<?php echo esc_attr( $style_key ); ?>][padding]"
                                               value="<?php echo esc_attr( $section_style['padding'] ?? 'var(--dthree-space-xl) 0' ); ?>"
                                               placeholder="var(--dthree-space-xl) 0">
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Section Background Colors', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'Default background colors for section styles.', 'dthree-gutenberg' ); ?></p>
                                <div class="section-bg-settings">
                                    <?php foreach ( $settings['section_layouts']['section_styles'] as $style_key => $section_style ) : ?>
                                    <div class="setting-group">
                                        <label><?php echo esc_html( $section_style['label'] ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[section_layouts][section_styles][<?php echo esc_attr( $style_key ); ?>][background]"
                                               value="<?php echo esc_attr( $section_style['background'] ?? 'transparent' ); ?>"
                                               class="color-picker">
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Usage in Gutenberg', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'All section layout types are available as custom block variations. Use them in the block editor by selecting the Group block and choosing a section layout variation.', 'dthree-gutenberg' ); ?></p>
                                <div class="usage-examples">
                                    <div class="code-example">
                                        <h4><?php esc_html_e( 'Example: Boxed Section', 'dthree-gutenberg' ); ?></h4>
                                        <pre><code>&lt;!-- wp:group {"className":"dthree-section-boxed dthree-section-padded"} --&gt;
&lt;div class="wp-block-group dthree-section-boxed dthree-section-padded"&gt;
    &lt;!-- Content here --&gt;
&lt;/div&gt;
&lt;!-- /wp:group --&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Builder Tab -->
                    <div class="tab-content" id="menus">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Menu Styling', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Customize typography, colors, and spacing for navigation menus. All menu layouts are available in your theme.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Menu Typography', 'dthree-gutenberg' ); ?></h3>
                                <div class="menu-typography-settings">
                                    <div class="setting-row">
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Font Size', 'dthree-gutenberg' ); ?></label>
                                            <input type="text" 
                                                   name="dthree_design_system[menu_builder][typography][font_size]"
                                                   value="<?php echo esc_attr( $settings['menu_builder']['typography']['font_size'] ?? 'var(--dthree-font-size-base)' ); ?>"
                                                   placeholder="16px">
                                        </div>
                                        
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Font Weight', 'dthree-gutenberg' ); ?></label>
                                            <select name="dthree_design_system[menu_builder][typography][font_weight]">
                                                <option value="300" <?php selected( $settings['menu_builder']['typography']['font_weight'] ?? '500', '300' ); ?>><?php esc_html_e( 'Light', 'dthree-gutenberg' ); ?></option>
                                                <option value="400" <?php selected( $settings['menu_builder']['typography']['font_weight'], '400' ); ?>><?php esc_html_e( 'Normal', 'dthree-gutenberg' ); ?></option>
                                                <option value="500" <?php selected( $settings['menu_builder']['typography']['font_weight'] ?? '500', '500' ); ?>><?php esc_html_e( 'Medium', 'dthree-gutenberg' ); ?></option>
                                                <option value="600" <?php selected( $settings['menu_builder']['typography']['font_weight'], '600' ); ?>><?php esc_html_e( 'Semi Bold', 'dthree-gutenberg' ); ?></option>
                                                <option value="700" <?php selected( $settings['menu_builder']['typography']['font_weight'], '700' ); ?>><?php esc_html_e( 'Bold', 'dthree-gutenberg' ); ?></option>
                                            </select>
                                        </div>
                                        
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Text Transform', 'dthree-gutenberg' ); ?></label>
                                            <select name="dthree_design_system[menu_builder][typography][text_transform]">
                                                <option value="none" <?php selected( $settings['menu_builder']['typography']['text_transform'] ?? 'none', 'none' ); ?>><?php esc_html_e( 'None', 'dthree-gutenberg' ); ?></option>
                                                <option value="uppercase" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'uppercase' ); ?>><?php esc_html_e( 'Uppercase', 'dthree-gutenberg' ); ?></option>
                                                <option value="lowercase" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'lowercase' ); ?>><?php esc_html_e( 'Lowercase', 'dthree-gutenberg' ); ?></option>
                                                <option value="capitalize" <?php selected( $settings['menu_builder']['typography']['text_transform'], 'capitalize' ); ?>><?php esc_html_e( 'Capitalize', 'dthree-gutenberg' ); ?></option>
                                            </select>
                                        </div>
                                        
                                        <div class="setting-group">
                                            <label><?php esc_html_e( 'Letter Spacing', 'dthree-gutenberg' ); ?></label>
                                            <input type="text" 
                                                   name="dthree_design_system[menu_builder][typography][letter_spacing]"
                                                   value="<?php echo esc_attr( $settings['menu_builder']['typography']['letter_spacing'] ?? '0' ); ?>"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Menu Colors', 'dthree-gutenberg' ); ?></h3>
                                <div class="menu-color-settings">
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Link Color', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][colors][link_color]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['colors']['link_color'] ?? 'var(--dthree-color-dark)' ); ?>"
                                               class="color-picker">
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Link Hover Color', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][colors][link_hover_color]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['colors']['link_hover_color'] ?? 'var(--dthree-color-primary)' ); ?>"
                                               class="color-picker">
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Active Link Color', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][colors][link_active_color]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['colors']['link_active_color'] ?? 'var(--dthree-color-primary)' ); ?>"
                                               class="color-picker">
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Dropdown Background', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][colors][dropdown_bg]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['colors']['dropdown_bg'] ?? '#ffffff' ); ?>"
                                               class="color-picker">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Menu Spacing', 'dthree-gutenberg' ); ?></h3>
                                <div class="menu-spacing-settings">
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Item Spacing', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][spacing][item_spacing]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['spacing']['item_spacing'] ?? 'var(--dthree-space-md)' ); ?>"
                                               placeholder="var(--dthree-space-md)">
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Dropdown Padding', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][spacing][dropdown_padding]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['spacing']['dropdown_padding'] ?? 'var(--dthree-space-sm)' ); ?>"
                                               placeholder="var(--dthree-space-sm)">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Mobile Menu Settings', 'dthree-gutenberg' ); ?></h3>
                                <div class="mobile-menu-settings">
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Breakpoint', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][mobile_menu][breakpoint]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['mobile_menu']['breakpoint'] ?? 'var(--dthree-breakpoint-md)' ); ?>"
                                               placeholder="768px">
                                        <small class="description"><?php esc_html_e( 'Screen width below which mobile menu is shown', 'dthree-gutenberg' ); ?></small>
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Hamburger Color', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][mobile_menu][hamburger_color]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['mobile_menu']['hamburger_color'] ?? 'var(--dthree-color-dark)' ); ?>"
                                               class="color-picker">
                                    </div>
                                    
                                    <div class="setting-group">
                                        <label><?php esc_html_e( 'Mobile Menu Background', 'dthree-gutenberg' ); ?></label>
                                        <input type="text" 
                                               name="dthree_design_system[menu_builder][mobile_menu][background]"
                                               value="<?php echo esc_attr( $settings['menu_builder']['mobile_menu']['background'] ?? '#ffffff' ); ?>"
                                               class="color-picker">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dthree-subsection">
                                <h3><?php esc_html_e( 'Available Menu Types', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'All menu layouts (horizontal, vertical, mega, split) are available in your theme. Use the WordPress menu system or custom navigation blocks to implement them.', 'dthree-gutenberg' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Animations Tab -->
                    <div class="tab-content" id="animations">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Micro-interactions', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Define smooth and purposeful animations for enhanced user experience.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Animation Durations', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['duration'] as $duration_key => $duration_value ) : ?>
                                <div class="size-item">
                                    <label for="duration_<?php echo esc_attr( $duration_key ); ?>">
                                        <?php echo esc_html( ucfirst( $duration_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="duration_<?php echo esc_attr( $duration_key ); ?>"
                                           name="dthree_design_system[animations][duration][<?php echo esc_attr( $duration_key ); ?>]" 
                                           value="<?php echo esc_attr( $duration_value ); ?>" />
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Easing Functions', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['easing'] as $easing_key => $easing_value ) : ?>
                                <div class="size-item">
                                    <label for="easing_<?php echo esc_attr( $easing_key ); ?>">
                                        <?php echo esc_html( ucfirst( str_replace( '_', ' ', $easing_key ) ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="easing_<?php echo esc_attr( $easing_key ); ?>"
                                           name="dthree_design_system[animations][easing][<?php echo esc_attr( $easing_key ); ?>]" 
                                           value="<?php echo esc_attr( $easing_value ); ?>" />
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h3><?php esc_html_e( 'Hover Effects', 'dthree-gutenberg' ); ?></h3>
                            <div class="dthree-size-grid">
                                <?php foreach ( $settings['animations']['hover_effects'] as $effect_key => $effect_value ) : ?>
                                <div class="size-item">
                                    <label for="hover_effect_<?php echo esc_attr( $effect_key ); ?>">
                                        <?php echo esc_html( ucfirst( $effect_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="hover_effect_<?php echo esc_attr( $effect_key ); ?>"
                                           name="dthree_design_system[animations][hover_effects][<?php echo esc_attr( $effect_key ); ?>]" 
                                           value="<?php echo esc_attr( $effect_value ); ?>" />
                                    <div class="effect-preview" data-effect="<?php echo esc_attr( $effect_key ); ?>">
                                        <div class="effect-demo"></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Tab -->
                    <div class="tab-content" id="responsive">
                        <div class="dthree-section">
                            <h2><?php esc_html_e( 'Responsive Design', 'dthree-gutenberg' ); ?></h2>
                            <p class="description"><?php esc_html_e( 'Configure breakpoints, container widths, and responsive typography settings.', 'dthree-gutenberg' ); ?></p>
                            
                            <h3><?php esc_html_e( 'Breakpoints', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'Define screen sizes where responsive styles take effect.', 'dthree-gutenberg' ); ?></p>
                            <div class="dthree-breakpoint-grid">
                                <?php 
                                $breakpoint_labels = array(
                                    'sm' => 'Small (Mobile)',
                                    'md' => 'Medium (Tablet)', 
                                    'lg' => 'Large (Desktop)',
                                    'xl' => 'Extra Large',
                                    'xxl' => 'XXL'
                                );
                                foreach ( $settings['breakpoints'] as $bp_key => $bp_value ) : ?>
                                <div class="breakpoint-item">
                                    <label for="breakpoint_<?php echo esc_attr( $bp_key ); ?>">
                                        <?php echo esc_html( $breakpoint_labels[$bp_key] ?? ucfirst( $bp_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="breakpoint_<?php echo esc_attr( $bp_key ); ?>"
                                           name="dthree_design_system[breakpoints][<?php echo esc_attr( $bp_key ); ?>]" 
                                           value="<?php echo esc_attr( $bp_value ); ?>" 
                                           placeholder="768px" />
                                    <small class="description">Min-width for <?php echo esc_html( strtolower( $breakpoint_labels[$bp_key] ?? $bp_key ) ); ?></small>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3><?php esc_html_e( 'Container Max Widths', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'Maximum width of containers at different screen sizes.', 'dthree-gutenberg' ); ?></p>
                            <div class="dthree-container-grid">
                                <?php foreach ( $settings['containers'] as $container_key => $container_value ) : ?>
                                <div class="container-item">
                                    <label for="container_<?php echo esc_attr( $container_key ); ?>">
                                        <?php echo esc_html( ucfirst( $container_key ) ); ?>
                                    </label>
                                    <input type="text" 
                                           id="container_<?php echo esc_attr( $container_key ); ?>"
                                           name="dthree_design_system[containers][<?php echo esc_attr( $container_key ); ?>]" 
                                           value="<?php echo esc_attr( $container_value ); ?>" 
                                           placeholder="1140px" />
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3><?php esc_html_e( 'Responsive Typography', 'dthree-gutenberg' ); ?></h3>
                            <p class="description"><?php esc_html_e( 'How typography scales across different devices.', 'dthree-gutenberg' ); ?></p>
                            
                            <div class="responsive-typography-controls">
                                <h4><?php esc_html_e( 'Font Scale Factors', 'dthree-gutenberg' ); ?></h4>
                                <p class="description"><?php esc_html_e( 'Multiplier for font sizes on different screen sizes (1.0 = 100%, 0.875 = 87.5%).', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="scale-factor-grid">
                                    <?php foreach ( $settings['responsive_typography']['scale_factor'] as $device => $factor ) : ?>
                                    <div class="scale-factor-item">
                                        <label for="scale_factor_<?php echo esc_attr( $device ); ?>">
                                            <?php echo esc_html( ucfirst( $device ) ); ?>
                                        </label>
                                        <input type="number" 
                                               class="scale-factor-input"
                                               id="scale_factor_<?php echo esc_attr( $device ); ?>"
                                               name="dthree_design_system[responsive_typography][scale_factor][<?php echo esc_attr( $device ); ?>]" 
                                               value="<?php echo esc_attr( $factor ); ?>" 
                                               step="0.01"
                                               min="0.5" 
                                               max="2" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <h4><?php esc_html_e( 'Line Height Adjustments', 'dthree-gutenberg' ); ?></h4>
                                <p class="description"><?php esc_html_e( 'Line height values optimized for different screen sizes.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="line-height-grid">
                                    <?php foreach ( $settings['responsive_typography']['line_height_adjustments'] as $device => $height ) : ?>
                                    <div class="line-height-item">
                                        <label for="line_height_<?php echo esc_attr( $device ); ?>">
                                            <?php echo esc_html( ucfirst( $device ) ); ?>
                                        </label>
                                        <input type="number" 
                                               id="line_height_<?php echo esc_attr( $device ); ?>"
                                               name="dthree_design_system[responsive_typography][line_height_adjustments][<?php echo esc_attr( $device ); ?>]" 
                                               value="<?php echo esc_attr( $height ); ?>" 
                                               step="0.01"
                                               min="1" 
                                               max="3" />
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="responsive-preview-section">
                                <h3><?php esc_html_e( 'Responsive Preview', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'See how your design system responds to different screen sizes.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="device-preview-controls">
                                    <button type="button" class="device-btn active" data-device="mobile">
                                        <span class="dashicons dashicons-smartphone"></span> Mobile
                                    </button>
                                    <button type="button" class="device-btn" data-device="tablet">
                                        <span class="dashicons dashicons-tablet"></span> Tablet
                                    </button>
                                    <button type="button" class="device-btn" data-device="desktop">
                                        <span class="dashicons dashicons-desktop"></span> Desktop
                                    </button>
                                </div>
                                
                                <div class="responsive-preview-frame">
                                    <div class="preview-device mobile active" data-device="mobile">
                                        <div class="preview-content">
                                            <h3>Mobile Preview</h3>
                                            <p>This is how your design system looks on mobile devices.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content adapts to mobile screens.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="preview-device tablet" data-device="tablet">
                                        <div class="preview-content">
                                            <h3>Tablet Preview</h3>
                                            <p>This is how your design system looks on tablet devices.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content optimized for tablet screens.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="preview-device desktop" data-device="desktop">
                                        <div class="preview-content">
                                            <h3>Desktop Preview</h3>
                                            <p>This is how your design system looks on desktop screens.</p>
                                            <button class="btn-primary">Primary Button</button>
                                            <div class="sample-card">
                                                <h4>Sample Card</h4>
                                                <p>Card content at full desktop size.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="responsive-utilities-info">
                                <h3><?php esc_html_e( 'Available Responsive Utilities', 'dthree-gutenberg' ); ?></h3>
                                <p class="description"><?php esc_html_e( 'Use these CSS classes for responsive design in your templates.', 'dthree-gutenberg' ); ?></p>
                                
                                <div class="utility-examples">
                                    <div class="utility-group">
                                        <h4>Grid Classes</h4>
                                        <code>.dthree-col-12</code> - Full width (mobile)<br>
                                        <code>.dthree-col-md-6</code> - Half width on tablet+<br>
                                        <code>.dthree-col-lg-4</code> - Third width on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Display Classes</h4>
                                        <code>.dthree-d-none</code> - Hidden on all screens<br>
                                        <code>.dthree-d-md-block</code> - Show on tablet+<br>
                                        <code>.dthree-d-lg-flex</code> - Flex on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Spacing Classes</h4>
                                        <code>.dthree-p-sm-md</code> - Medium padding on mobile<br>
                                        <code>.dthree-mb-md-lg</code> - Large margin-bottom on tablet+<br>
                                        <code>.dthree-px-lg-xl</code> - X-large horizontal padding on desktop+
                                    </div>
                                    
                                    <div class="utility-group">
                                        <h4>Typography Classes</h4>
                                        <code>.dthree-text-sm-center</code> - Center on mobile<br>
                                        <code>.dthree-text-md-left</code> - Left-align on tablet+<br>
                                        <code>.dthree-text-lg-right</code> - Right-align on desktop+
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dthree-form-actions">
                    <?php submit_button( __( 'Save Design System', 'dthree-gutenberg' ), 'primary', 'submit', false ); ?>
                    
                    <button type="button" class="button button-secondary" id="dthree-preview-btn">
                        <span class="dashicons dashicons-visibility"></span>
                        <?php esc_html_e( 'Preview Changes', 'dthree-gutenberg' ); ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="dthree-admin-sidebar">
            <div class="dthree-panel">
                <h3><?php esc_html_e( 'Live Preview', 'dthree-gutenberg' ); ?></h3>
                <div id="dthree-live-preview">
                    <div class="preview-components">
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Typography', 'dthree-gutenberg' ); ?></h4>
                            <h1>Heading 1</h1>
                            <h2>Heading 2</h2>
                            <h3>Heading 3</h3>
                            <p>This is a paragraph of body text to show typography styles.</p>
                        </div>
                        
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Buttons', 'dthree-gutenberg' ); ?></h4>
                            <div class="button-group">
                                <button class="btn-preview btn-primary">Primary</button>
                                <button class="btn-preview btn-secondary">Secondary</button>
                                <button class="btn-preview btn-outline">Outline</button>
                                <button class="btn-preview btn-ghost">Ghost</button>
                            </div>
                        </div>
                        
                        <div class="preview-section">
                            <h4><?php esc_html_e( 'Colors', 'dthree-gutenberg' ); ?></h4>
                            <div class="color-swatches">
                                <div class="swatch primary-swatch"></div>
                                <div class="swatch secondary-swatch"></div>
                                <div class="swatch success-swatch"></div>
                                <div class="swatch warning-swatch"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="dthree-panel">
                <h3><?php esc_html_e( 'Build Status', 'dthree-gutenberg' ); ?></h3>
                <div id="dthree-build-status">
                    <p class="description"><?php esc_html_e( 'Click "Build Assets" to generate optimized CSS, JS, and templates.', 'dthree-gutenberg' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="dthree-import-modal" class="dthree-modal" style="display: none;">
    <div class="dthree-modal-content">
        <span class="dthree-modal-close">&times;</span>
        <h2><?php esc_html_e( 'Import Design System', 'dthree-gutenberg' ); ?></h2>
        <p><?php esc_html_e( 'Upload a JSON file to import design system settings.', 'dthree-gutenberg' ); ?></p>
        <input type="file" id="dthree-import-file" accept=".json" />
        <button type="button" class="button button-primary" id="dthree-import-confirm">
            <?php esc_html_e( 'Import', 'dthree-gutenberg' ); ?>
        </button>
    </div>
</div>