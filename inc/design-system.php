<?php
/**
 * Design System Core Class
 *
 * @package DThree_Gutenberg
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DThree_Design_System {
    
    /**
     * Instance of this class
     */
    private static $instance = null;
    
    /**
     * Design System Settings Key
     */
    const SETTINGS_KEY = 'dthree_design_system';
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
        add_action( 'wp_ajax_dthree_build_assets', array( $this, 'ajax_build_assets' ) );
        add_action( 'wp_ajax_dthree_preview_changes', array( $this, 'ajax_preview_changes' ) );
        add_action( 'wp_ajax_dthree_export_design_system', array( $this, 'ajax_export_design_system' ) );
        add_action( 'wp_ajax_dthree_import_design_system', array( $this, 'ajax_import_design_system' ) );
        add_action( 'wp_ajax_dthree_search_google_fonts', array( $this, 'ajax_search_google_fonts' ) );
        add_action( 'wp_ajax_dthree_upload_custom_font', array( $this, 'ajax_upload_custom_font' ) );
    }
    
    /**
     * Get instance
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_theme_page(
            __( 'Design System', 'dthree-gutenberg' ),
            __( 'Design System', 'dthree-gutenberg' ),
            'edit_theme_options',
            'dthree-design-system',
            array( $this, 'admin_page' )
        );
    }
    
    /**
     * Admin initialization
     */
    public function admin_init() {
        register_setting( self::SETTINGS_KEY, self::SETTINGS_KEY );
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts( $hook ) {
        if ( $hook !== 'appearance_page_dthree-design-system' ) {
            return;
        }
        
        wp_enqueue_script(
            'dthree-design-system-admin',
            DTHREE_THEME_URI . '/assets/js/design-system-admin.js',
            array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ),
            DTHREE_VERSION,
            true
        );
        
        wp_enqueue_style(
            'dthree-design-system-admin',
            DTHREE_THEME_URI . '/assets/css/design-system-admin.css',
            array( 'wp-color-picker' ),
            DTHREE_VERSION
        );
        
        wp_localize_script( 'dthree-design-system-admin', 'dthreeDesignSystem', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'dthree_design_system_nonce' ),
            'strings' => array(
                'building' => __( 'Building assets...', 'dthree-gutenberg' ),
                'built' => __( 'Assets built successfully!', 'dthree-gutenberg' ),
                'error' => __( 'Error building assets', 'dthree-gutenberg' ),
                'preview' => __( 'Generating preview...', 'dthree-gutenberg' ),
                'exported' => __( 'Design system exported successfully!', 'dthree-gutenberg' ),
                'imported' => __( 'Design system imported successfully!', 'dthree-gutenberg' ),
            )
        ) );
    }
    
    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Enqueue generated design system CSS
        $design_system_css = $this->get_generated_css_file();
        if ( file_exists( $design_system_css ) ) {
            wp_enqueue_style(
                'dthree-design-system',
                DTHREE_THEME_URI . '/assets/css/generated/design-system.css',
                array( 'dthree-custom' ),
                filemtime( $design_system_css )
            );
        }
        
        // Enqueue micro-interactions JS
        wp_enqueue_script(
            'dthree-micro-interactions',
            DTHREE_THEME_URI . '/assets/js/micro-interactions.js',
            array( 'jquery' ),
            DTHREE_VERSION,
            true
        );
        
        // Enqueue menu and section layout JS
        wp_enqueue_script(
            'dthree-menu-section-layouts',
            DTHREE_THEME_URI . '/assets/js/menu-section-layouts.js',
            array( 'jquery', 'dthree-micro-interactions' ),
            DTHREE_VERSION,
            true
        );
    }
    
    /**
     * Get default design system settings
     */
    public function get_default_settings() {
        return array(
            // Colors
            'colors' => array(
                'primary' => '#0d6efd',
                'secondary' => '#6c757d',
                'success' => '#198754',
                'danger' => '#dc3545',
                'warning' => '#ffc107',
                'info' => '#0dcaf0',
                'light' => '#f8f9fa',
                'dark' => '#212529',
                'white' => '#ffffff',
                'black' => '#000000',
            ),
            
            // Typography
            'typography' => array(
                'font_family_primary' => array(
                    'family' => 'Inter',
                    'source' => 'google', // 'google', 'custom', or 'system'
                    'google_url' => '', // Auto-generated Google Fonts URL
                    'fallbacks' => 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',
                    'weights' => array( 300, 400, 500, 600, 700 ),
                    'custom_files' => array(), // Array of uploaded font file paths
                ),
                'font_family_secondary' => array(
                    'family' => 'Georgia',
                    'source' => 'system',
                    'google_url' => '',
                    'fallbacks' => 'serif',
                    'weights' => array( 400, 700 ),
                    'custom_files' => array(),
                ),
                'font_sizes' => array(
                    'xs' => '0.75rem',    // 12px
                    'sm' => '0.875rem',   // 14px
                    'base' => '1rem',     // 16px
                    'lg' => '1.125rem',   // 18px
                    'xl' => '1.25rem',    // 20px
                    '2xl' => '1.5rem',    // 24px
                    '3xl' => '1.875rem',  // 30px
                    '4xl' => '2.25rem',   // 36px
                    '5xl' => '3rem',      // 48px
                    '6xl' => '3.75rem',   // 60px
                ),
                'line_heights' => array(
                    'tight' => '1.25',
                    'normal' => '1.5',
                    'relaxed' => '1.625',
                    'loose' => '2',
                ),
            ),
            
            // Spacing
            'spacing' => array(
                'scale' => array(
                    'xs' => '0.25rem',   // 4px
                    'sm' => '0.5rem',    // 8px
                    'md' => '1rem',      // 16px
                    'lg' => '1.5rem',    // 24px
                    'xl' => '2rem',      // 32px
                    '2xl' => '3rem',     // 48px
                    '3xl' => '4rem',     // 64px
                    '4xl' => '6rem',     // 96px
                    '5xl' => '8rem',     // 128px
                ),
            ),
            
            // Border Radius
            'border_radius' => array(
                'none' => '0',
                'sm' => '0.125rem',     // 2px
                'base' => '0.25rem',    // 4px
                'md' => '0.375rem',     // 6px
                'lg' => '0.5rem',       // 8px
                'xl' => '0.75rem',      // 12px
                '2xl' => '1rem',        // 16px
                '3xl' => '1.5rem',      // 24px
                'full' => '9999px',
            ),
            
            // Shadows
            'shadows' => array(
                'none' => 'none',
                'sm' => '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'base' => '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                'md' => '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                'lg' => '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                'xl' => '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                '2xl' => '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
            ),
            
            // Button Components
            'buttons' => array(
                'primary' => array(
                    // Default state
                    'background' => 'var(--dthree-color-primary)',
                    'color' => '#ffffff',
                    'border' => 'var(--dthree-color-primary)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'transition' => 'all 0.2s ease-in-out',
                    // Hover state
                    'hover_background' => '#0b5ed7',
                    'hover_color' => '#ffffff',
                    'hover_border' => '#0b5ed7',
                    'hover_transform' => 'translateY(-1px)',
                    'hover_shadow' => '0 4px 6px rgba(0, 0, 0, 0.1)',
                    // Active state
                    'active_background' => '#0a58ca',
                    'active_color' => '#ffffff',
                    'active_border' => '#0a58ca',
                    'active_transform' => 'translateY(0)',
                    'active_shadow' => '0 2px 4px rgba(0, 0, 0, 0.1)',
                    // Focus state
                    'focus_outline' => '0 0 0 0.25rem rgba(13, 110, 253, 0.25)',
                    'focus_border' => 'var(--dthree-color-primary)',
                    // Disabled state
                    'disabled_background' => '#6c757d',
                    'disabled_color' => '#ffffff',
                    'disabled_border' => '#6c757d',
                    'disabled_opacity' => '0.65',
                    'disabled_cursor' => 'not-allowed',
                ),
                'secondary' => array(
                    // Default state
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-primary)',
                    'border' => 'var(--dthree-color-primary)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'transition' => 'all 0.2s ease-in-out',
                    // Hover state
                    'hover_background' => 'var(--dthree-color-primary)',
                    'hover_color' => '#ffffff',
                    'hover_border' => 'var(--dthree-color-primary)',
                    'hover_transform' => 'translateY(-1px)',
                    'hover_shadow' => '0 4px 6px rgba(0, 0, 0, 0.1)',
                    // Active state
                    'active_background' => '#0a58ca',
                    'active_color' => '#ffffff',
                    'active_border' => '#0a58ca',
                    'active_transform' => 'translateY(0)',
                    'active_shadow' => '0 2px 4px rgba(0, 0, 0, 0.1)',
                    // Focus state
                    'focus_outline' => '0 0 0 0.25rem rgba(13, 110, 253, 0.25)',
                    'focus_border' => 'var(--dthree-color-primary)',
                    // Disabled state
                    'disabled_background' => 'transparent',
                    'disabled_color' => '#6c757d',
                    'disabled_border' => '#6c757d',
                    'disabled_opacity' => '0.65',
                    'disabled_cursor' => 'not-allowed',
                ),
                'outline' => array(
                    // Default state
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-dark)',
                    'border' => '2px solid var(--dthree-color-dark)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'transition' => 'all 0.2s ease-in-out',
                    // Hover state
                    'hover_background' => 'var(--dthree-color-dark)',
                    'hover_color' => '#ffffff',
                    'hover_border' => 'var(--dthree-color-dark)',
                    'hover_transform' => 'translateY(-1px)',
                    'hover_shadow' => '0 4px 6px rgba(0, 0, 0, 0.1)',
                    // Active state
                    'active_background' => '#1a1d20',
                    'active_color' => '#ffffff',
                    'active_border' => '#1a1d20',
                    'active_transform' => 'translateY(0)',
                    'active_shadow' => '0 2px 4px rgba(0, 0, 0, 0.1)',
                    // Focus state
                    'focus_outline' => '0 0 0 0.25rem rgba(33, 37, 41, 0.25)',
                    'focus_border' => 'var(--dthree-color-dark)',
                    // Disabled state
                    'disabled_background' => 'transparent',
                    'disabled_color' => '#6c757d',
                    'disabled_border' => '#6c757d',
                    'disabled_opacity' => '0.65',
                    'disabled_cursor' => 'not-allowed',
                ),
                'ghost' => array(
                    // Default state
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-primary)',
                    'border' => 'transparent',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'transition' => 'all 0.2s ease-in-out',
                    // Hover state
                    'hover_background' => 'rgba(13, 110, 253, 0.1)',
                    'hover_color' => 'var(--dthree-color-primary)',
                    'hover_border' => 'transparent',
                    'hover_transform' => 'translateY(-1px)',
                    'hover_shadow' => 'none',
                    // Active state
                    'active_background' => 'rgba(13, 110, 253, 0.2)',
                    'active_color' => 'var(--dthree-color-primary)',
                    'active_border' => 'transparent',
                    'active_transform' => 'translateY(0)',
                    'active_shadow' => 'none',
                    // Focus state
                    'focus_outline' => '0 0 0 0.25rem rgba(13, 110, 253, 0.25)',
                    'focus_border' => 'transparent',
                    // Disabled state
                    'disabled_background' => 'transparent',
                    'disabled_color' => '#6c757d',
                    'disabled_border' => 'transparent',
                    'disabled_opacity' => '0.65',
                    'disabled_cursor' => 'not-allowed',
                ),
            ),
            
            // Micro-interactions
            'animations' => array(
                'duration' => array(
                    'fast' => '0.15s',
                    'normal' => '0.3s',
                    'slow' => '0.5s',
                ),
                'easing' => array(
                    'ease' => 'ease',
                    'ease_in' => 'ease-in',
                    'ease_out' => 'ease-out',
                    'ease_in_out' => 'ease-in-out',
                    'bounce' => 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                    'smooth' => 'cubic-bezier(0.4, 0, 0.2, 1)',
                ),
                'hover_effects' => array(
                    'lift' => 'translateY(-2px)',
                    'scale' => 'scale(1.02)',
                    'rotate' => 'rotate(2deg)',
                ),
            ),
            
            // Responsive Breakpoints
            'breakpoints' => array(
                'sm' => '480px',   // Small mobile
                'md' => '768px',   // Tablet
                'lg' => '1024px',  // Desktop
                'xl' => '1200px',  // Large desktop
                'xxl' => '1400px', // Extra large
            ),
            
            // Container Widths
            'containers' => array(
                'sm' => '540px',
                'md' => '720px',
                'lg' => '960px',
                'xl' => '1140px',
                'xxl' => '1320px',
                'fluid' => '100%',
            ),
            
            // Responsive Typography
            'responsive_typography' => array(
                'scale_factor' => array(
                    'mobile' => 0.875,   // 87.5% of base size on mobile
                    'tablet' => 0.9375,  // 93.75% of base size on tablet  
                    'desktop' => 1,      // 100% base size on desktop
                ),
                'line_height_adjustments' => array(
                    'mobile' => 1.4,
                    'tablet' => 1.45,
                    'desktop' => 1.5,
                ),
            ),
            
            // Section Layouts - Styling Only
            'section_layouts' => array(
                'container_types' => array(
                    'full_width' => array(
                        'label' => 'Full Width',
                        'description' => 'Content spans the entire viewport width',
                        'max_width' => 'none',
                    ),
                    'boxed' => array(
                        'label' => 'Boxed',
                        'description' => 'Content contained within max-width bounds',
                        'max_width' => 'var(--dthree-container-xl)',
                    ),
                    'narrow' => array(
                        'label' => 'Narrow',
                        'description' => 'Content in a narrow, centered container',
                        'max_width' => 'var(--dthree-container-sm)',
                    ),
                    'wide' => array(
                        'label' => 'Wide',
                        'description' => 'Content in an extended container',
                        'max_width' => 'var(--dthree-container-xxl)',
                    ),
                ),
                'section_styles' => array(
                    'minimal' => array(
                        'label' => 'Minimal',
                        'padding' => 'var(--dthree-space-xl) 0',
                        'background' => 'transparent',
                    ),
                    'padded' => array(
                        'label' => 'Padded',
                        'padding' => 'var(--dthree-space-3xl) 0',
                        'background' => 'transparent',
                    ),
                    'featured' => array(
                        'label' => 'Featured',
                        'padding' => 'var(--dthree-space-4xl) 0',
                        'background' => 'var(--dthree-color-light)',
                    ),
                    'hero' => array(
                        'label' => 'Hero',
                        'padding' => 'var(--dthree-space-5xl) 0',
                        'background' => 'linear-gradient(135deg, var(--dthree-color-primary), var(--dthree-color-secondary))',
                    ),
                ),
            ),
            
            // Menu Builder - Styling Only
            'menu_builder' => array(
                'typography' => array(
                    'font_size' => 'var(--dthree-font-size-base)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'letter_spacing' => '0',
                ),
                'colors' => array(
                    'link_color' => 'var(--dthree-color-dark)',
                    'link_hover_color' => 'var(--dthree-color-primary)',
                    'link_active_color' => 'var(--dthree-color-primary)',
                    'dropdown_bg' => '#ffffff',
                ),
                'spacing' => array(
                    'item_spacing' => 'var(--dthree-space-md)',
                    'dropdown_padding' => 'var(--dthree-space-sm)',
                ),
                'mobile_menu' => array(
                    'breakpoint' => 'var(--dthree-breakpoint-md)',
                    'hamburger_color' => 'var(--dthree-color-dark)',
                    'background' => '#ffffff',
                ),
            ),
            
            // Micro-interactions
            'animations' => array(
                'duration' => array(
                    'fast' => '0.15s',
                    'normal' => '0.3s',
                    'slow' => '0.5s',
                ),
                'easing' => array(
                    'ease' => 'ease',
                    'ease_in' => 'ease-in',
                    'ease_out' => 'ease-out',
                    'ease_in_out' => 'ease-in-out',
                    'bounce' => 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                    'smooth' => 'cubic-bezier(0.4, 0, 0.2, 1)',
                ),
                'hover_effects' => array(
                    'lift' => 'translateY(-2px)',
                    'scale' => 'scale(1.02)',
                    'rotate' => 'rotate(2deg)',
                ),
            ),
        );
    }
    
    /**
     * Get current settings
     */
    public function get_settings() {
        $saved_settings = get_option( self::SETTINGS_KEY, array() );
        $default_settings = $this->get_default_settings();
        
        return wp_parse_args( $saved_settings, $default_settings );
    }
    
    /**
     * Save settings
     */
    public function save_settings( $settings ) {
        return update_option( self::SETTINGS_KEY, $settings );
    }
    
    /**
     * Get generated CSS file path
     */
    private function get_generated_css_file() {
        $upload_dir = wp_upload_dir();
        return $upload_dir['basedir'] . '/dthree-design-system/design-system.css';
    }
    
    /**
     * Admin page template
     */
    public function admin_page() {
        $settings = $this->get_settings();
        include DTHREE_THEME_DIR . '/inc/design-system/admin-template.php';
    }
    
    /**
     * AJAX: Build Assets
     */
    public function ajax_build_assets() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        $result = $this->build_assets();
        
        if ( $result ) {
            wp_send_json_success( array( 'message' => 'Assets built successfully!' ) );
        } else {
            wp_send_json_error( array( 'message' => 'Error building assets' ) );
        }
    }
    
    /**
     * Build design system assets
     */
    public function build_assets() {
        $settings = $this->get_settings();
        
        // Create upload directory
        $upload_dir = wp_upload_dir();
        $design_system_dir = $upload_dir['basedir'] . '/dthree-design-system';
        
        if ( ! file_exists( $design_system_dir ) ) {
            wp_mkdir_p( $design_system_dir );
        }
        
        // Generate CSS
        $css_content = $this->generate_css( $settings );
        $css_file = $design_system_dir . '/design-system.css';
        
        $css_result = file_put_contents( $css_file, $css_content );
        
        // Copy to theme assets directory for theme integration
        $theme_css_dir = DTHREE_THEME_DIR . '/assets/css/generated';
        if ( ! file_exists( $theme_css_dir ) ) {
            wp_mkdir_p( $theme_css_dir );
        }
        copy( $css_file, $theme_css_dir . '/design-system.css' );
        
        // Generate JavaScript for micro-interactions
        $js_content = $this->generate_javascript( $settings );
        $js_file = $design_system_dir . '/micro-interactions.js';
        
        $js_result = file_put_contents( $js_file, $js_content );
        
        // Copy to theme assets directory
        copy( $js_file, DTHREE_THEME_DIR . '/assets/js/micro-interactions.js' );
        
        return $css_result !== false && $js_result !== false;
    }
    
    /**
     * Generate CSS from settings
     */
    private function generate_css( $settings ) {
        ob_start();
        include DTHREE_THEME_DIR . '/inc/design-system/css-generator.php';
        return ob_get_clean();
    }
    
    /**
     * Generate JavaScript from settings
     */
    private function generate_javascript( $settings ) {
        ob_start();
        include DTHREE_THEME_DIR . '/inc/design-system/js-generator.php';
        return ob_get_clean();
    }
    
    /**
     * AJAX: Preview Changes
     */
    public function ajax_preview_changes() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        $preview_settings = json_decode( stripslashes( $_POST['settings'] ), true );
        $preview_css = $this->generate_css( $preview_settings );
        
        wp_send_json_success( array( 'css' => $preview_css ) );
    }
    
    /**
     * AJAX: Export Design System
     */
    public function ajax_export_design_system() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        $settings = $this->get_settings();
        $export_data = array(
            'version' => DTHREE_VERSION,
            'exported' => current_time( 'Y-m-d H:i:s' ),
            'settings' => $settings,
        );
        
        wp_send_json_success( array( 
            'data' => $export_data,
            'filename' => 'dthree-design-system-' . date( 'Y-m-d-H-i-s' ) . '.json'
        ) );
    }
    
    /**
     * AJAX: Import Design System
     */
    public function ajax_import_design_system() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        $import_data = json_decode( stripslashes( $_POST['data'] ), true );
        
        if ( isset( $import_data['settings'] ) ) {
            $this->save_settings( $import_data['settings'] );
            wp_send_json_success( array( 'message' => 'Design system imported successfully!' ) );
        } else {
            wp_send_json_error( array( 'message' => 'Invalid import data' ) );
        }
    }
    
    /**
     * AJAX handler for Google Fonts search
     */
    public function ajax_search_google_fonts() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        $search_term = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
        
        // Popular Google Fonts list (top 100)
        $google_fonts = array(
            'Roboto', 'Open Sans', 'Lato', 'Montserrat', 'Oswald', 'Source Sans Pro', 
            'Raleway', 'Poppins', 'Merriweather', 'PT Sans', 'Ubuntu', 'Nunito',
            'Playfair Display', 'Rubik', 'Lora', 'Inter', 'Mukta', 'Work Sans',
            'Noto Sans', 'Fira Sans', 'Quicksand', 'Karla', 'Barlow', 'Manrope',
            'DM Sans', 'Plus Jakarta Sans', 'Space Grotesk', 'Epilogue', 'Outfit',
            'Sora', 'Urbanist', 'Lexend', 'Red Hat Display', 'Archivo', 'IBM Plex Sans',
            'Josefin Sans', 'Inconsolata', 'Oxygen', 'Titillium Web', 'Cabin',
            'Dosis', 'Hind', 'Bitter', 'Arimo', 'Fjalla One', 'Anton', 'Dancing Script',
            'Pacifico', 'Bebas Neue', 'Satisfy', 'Crimson Text', 'Libre Baskerville',
            'Shadows Into Light', 'Cookie', 'Lobster', 'Great Vibes', 'Permanent Marker',
        );
        
        // Filter by search term
        if ( ! empty( $search_term ) ) {
            $google_fonts = array_filter( $google_fonts, function( $font ) use ( $search_term ) {
                return stripos( $font, $search_term ) !== false;
            } );
        }
        
        // Return first 20 results
        $results = array_slice( array_values( $google_fonts ), 0, 20 );
        
        wp_send_json_success( array( 'fonts' => $results ) );
    }
    
    /**
     * AJAX handler for custom font upload
     */
    public function ajax_upload_custom_font() {
        // Verify nonce
        if ( ! check_ajax_referer( 'dthree_design_system_nonce', 'nonce', false ) ) {
            wp_die( 'Security check failed' );
        }
        
        // Check permissions
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die( 'Insufficient permissions' );
        }
        
        // Check if file was uploaded
        if ( empty( $_FILES['font_file'] ) ) {
            wp_send_json_error( array( 'message' => 'No file uploaded' ) );
        }
        
        $file = $_FILES['font_file'];
        $font_name = isset( $_POST['font_name'] ) ? sanitize_text_field( $_POST['font_name'] ) : '';
        
        // Allowed font file types
        $allowed_types = array( 'woff', 'woff2', 'ttf', 'otf', 'eot' );
        $file_ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
        
        if ( ! in_array( strtolower( $file_ext ), $allowed_types ) ) {
            wp_send_json_error( array( 'message' => 'Invalid file type. Allowed: .woff, .woff2, .ttf, .otf, .eot' ) );
        }
        
        // Create custom fonts directory
        $upload_dir = wp_upload_dir();
        $fonts_dir = $upload_dir['basedir'] . '/design-system/fonts';
        
        if ( ! file_exists( $fonts_dir ) ) {
            wp_mkdir_p( $fonts_dir );
        }
        
        // Generate unique filename
        $filename = sanitize_file_name( $font_name . '.' . $file_ext );
        $filepath = $fonts_dir . '/' . $filename;
        
        // Move uploaded file
        if ( move_uploaded_file( $file['tmp_name'], $filepath ) ) {
            $file_url = $upload_dir['baseurl'] . '/design-system/fonts/' . $filename;
            
            wp_send_json_success( array( 
                'message' => 'Font uploaded successfully!',
                'file_path' => $filepath,
                'file_url' => $file_url,
                'file_type' => $file_ext,
            ) );
        } else {
            wp_send_json_error( array( 'message' => 'Failed to upload font file' ) );
        }
    }
}

// Initialize the Design System
DThree_Design_System::get_instance();