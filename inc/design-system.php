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
                    'fallbacks' => 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',
                    'weights' => array( 300, 400, 500, 600, 700 )
                ),
                'font_family_secondary' => array(
                    'family' => 'Georgia',
                    'fallbacks' => 'serif',
                    'weights' => array( 400, 700 )
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
                    'background' => 'var(--dthree-color-primary)',
                    'color' => '#ffffff',
                    'border' => 'var(--dthree-color-primary)',
                    'hover_background' => 'var(--dthree-color-primary-dark)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'transition' => 'all 0.2s ease-in-out',
                ),
                'secondary' => array(
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-primary)',
                    'border' => 'var(--dthree-color-primary)',
                    'hover_background' => 'var(--dthree-color-primary)',
                    'hover_color' => '#ffffff',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'transition' => 'all 0.2s ease-in-out',
                ),
                'outline' => array(
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-dark)',
                    'border' => '2px solid var(--dthree-color-light)',
                    'hover_background' => 'var(--dthree-color-light)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'transition' => 'all 0.2s ease-in-out',
                ),
                'ghost' => array(
                    'background' => 'transparent',
                    'color' => 'var(--dthree-color-primary)',
                    'border' => 'transparent',
                    'hover_background' => 'rgba(13, 110, 253, 0.1)',
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-lg)',
                    'border_radius' => 'var(--dthree-radius-md)',
                    'font_weight' => '500',
                    'transition' => 'all 0.2s ease-in-out',
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
            
            // Section Layouts
            'section_layouts' => array(
                'default_container' => 'boxed',
                'enabled_styles' => array( 'minimal', 'padded', 'featured', 'hero' ),
                'container_types' => array(
                    'full_width' => array(
                        'label' => 'Full Width',
                        'description' => 'Content spans the entire viewport width',
                        'max_width' => 'none',
                        'padding' => '0',
                        'background' => 'none',
                        'css_class' => 'dthree-section-full-width',
                    ),
                    'boxed' => array(
                        'label' => 'Boxed',
                        'description' => 'Content contained within max-width bounds',
                        'max_width' => 'var(--dthree-container-xl)',
                        'padding' => '0 var(--dthree-space-lg)',
                        'margin' => '0 auto',
                        'css_class' => 'dthree-section-boxed',
                    ),
                    'narrow' => array(
                        'label' => 'Narrow',
                        'description' => 'Content in a narrow, centered container',
                        'max_width' => 'var(--dthree-container-sm)',
                        'padding' => '0 var(--dthree-space-lg)',
                        'margin' => '0 auto',
                        'css_class' => 'dthree-section-narrow',
                    ),
                    'wide' => array(
                        'label' => 'Wide',
                        'description' => 'Content in an extended container',
                        'max_width' => 'var(--dthree-container-xxl)',
                        'padding' => '0 var(--dthree-space-lg)',
                        'margin' => '0 auto',
                        'css_class' => 'dthree-section-wide',
                    ),
                    'custom' => array(
                        'label' => 'Custom',
                        'description' => 'User-defined container settings',
                        'max_width' => '1200px',
                        'padding' => '0 20px',
                        'margin' => '0 auto',
                        'css_class' => 'dthree-section-custom',
                    ),
                ),
                'section_styles' => array(
                    'minimal' => array(
                        'label' => 'Minimal',
                        'padding_y' => 'var(--dthree-space-xl)',
                        'background' => 'transparent',
                        'border' => 'none',
                    ),
                    'padded' => array(
                        'label' => 'Padded',
                        'padding_y' => 'var(--dthree-space-3xl)',
                        'background' => 'transparent',
                        'border' => 'none',
                    ),
                    'featured' => array(
                        'label' => 'Featured',
                        'padding_y' => 'var(--dthree-space-4xl)',
                        'background' => 'var(--dthree-color-light)',
                        'border' => '1px solid var(--dthree-color-border)',
                        'border_radius' => 'var(--dthree-radius-lg)',
                    ),
                    'hero' => array(
                        'label' => 'Hero',
                        'padding_y' => 'var(--dthree-space-5xl)',
                        'background' => 'linear-gradient(135deg, var(--dthree-color-primary), var(--dthree-color-secondary))',
                        'color' => 'var(--dthree-color-white)',
                        'text_align' => 'center',
                    ),
                ),
                'spacing_options' => array(
                    'none' => '0',
                    'xs' => 'var(--dthree-space-xs)',
                    'sm' => 'var(--dthree-space-sm)',
                    'md' => 'var(--dthree-space-md)',
                    'lg' => 'var(--dthree-space-lg)',
                    'xl' => 'var(--dthree-space-xl)',
                    '2xl' => 'var(--dthree-space-2xl)',
                    '3xl' => 'var(--dthree-space-3xl)',
                    '4xl' => 'var(--dthree-space-4xl)',
                    '5xl' => 'var(--dthree-space-5xl)',
                ),
            ),
            
            // Menu Builder
            'menu_builder' => array(
                'default_style' => 'horizontal',
                'default_dropdown' => 'simple',
                'menu_styles' => array(
                    'horizontal' => array(
                        'label' => 'Horizontal',
                        'description' => 'Standard horizontal menu layout',
                        'display' => 'flex',
                        'flex_direction' => 'row',
                        'align_items' => 'center',
                        'gap' => 'var(--dthree-space-lg)',
                        'css_class' => 'dthree-menu-horizontal',
                    ),
                    'vertical' => array(
                        'label' => 'Vertical',
                        'description' => 'Vertical sidebar-style menu',
                        'display' => 'flex',
                        'flex_direction' => 'column',
                        'gap' => 'var(--dthree-space-sm)',
                        'css_class' => 'dthree-menu-vertical',
                    ),
                    'mega' => array(
                        'label' => 'Mega Menu',
                        'description' => 'Full-width dropdown with multiple columns',
                        'display' => 'flex',
                        'flex_direction' => 'row',
                        'dropdown_type' => 'mega',
                        'dropdown_columns' => 4,
                        'css_class' => 'dthree-menu-mega',
                    ),
                    'centered' => array(
                        'label' => 'Centered',
                        'description' => 'Center-aligned horizontal menu',
                        'display' => 'flex',
                        'flex_direction' => 'row',
                        'justify_content' => 'center',
                        'gap' => 'var(--dthree-space-lg)',
                        'css_class' => 'dthree-menu-centered',
                    ),
                    'split' => array(
                        'label' => 'Split Menu',
                        'description' => 'Menu items split around logo/branding',
                        'display' => 'flex',
                        'justify_content' => 'space-between',
                        'css_class' => 'dthree-menu-split',
                    ),
                ),
                'dropdown_styles' => array(
                    'simple' => array(
                        'label' => 'Simple Dropdown',
                        'animation' => 'fade',
                        'background' => 'var(--dthree-color-white)',
                        'border' => '1px solid var(--dthree-color-border)',
                        'border_radius' => 'var(--dthree-radius-md)',
                        'box_shadow' => '0 4px 12px rgba(0,0,0,0.1)',
                        'padding' => 'var(--dthree-space-sm)',
                        'min_width' => '200px',
                    ),
                    'card' => array(
                        'label' => 'Card Style',
                        'animation' => 'slide_down',
                        'background' => 'var(--dthree-color-white)',
                        'border' => 'none',
                        'border_radius' => 'var(--dthree-radius-lg)',
                        'box_shadow' => '0 8px 25px rgba(0,0,0,0.15)',
                        'padding' => 'var(--dthree-space-lg)',
                        'min_width' => '250px',
                    ),
                    'mega' => array(
                        'label' => 'Mega Dropdown',
                        'animation' => 'slide_down',
                        'background' => 'var(--dthree-color-white)',
                        'border' => 'none',
                        'border_radius' => 'var(--dthree-radius-lg)',
                        'box_shadow' => '0 12px 35px rgba(0,0,0,0.1)',
                        'padding' => 'var(--dthree-space-2xl)',
                        'width' => '100%',
                        'max_width' => 'var(--dthree-container-xl)',
                        'columns' => 'repeat(auto-fit, minmax(200px, 1fr))',
                    ),
                ),
                'mobile_menu' => array(
                    'style' => 'slide_in', // slide_in, overlay, push
                    'position' => 'left', // left, right, top
                    'background' => 'var(--dthree-color-white)',
                    'width' => '280px',
                    'animation_duration' => '0.3s',
                    'overlay_background' => 'rgba(0,0,0,0.5)',
                    'hamburger_style' => 'lines', // lines, dots, arrow
                ),
                'menu_item_styles' => array(
                    'padding' => 'var(--dthree-space-sm) var(--dthree-space-md)',
                    'border_radius' => 'var(--dthree-radius-sm)',
                    'transition' => 'all 0.2s ease',
                    'hover_background' => 'rgba(13, 110, 253, 0.1)',
                    'active_background' => 'var(--dthree-color-primary)',
                    'active_color' => 'var(--dthree-color-white)',
                ),
                'typography' => array(
                    'font_family' => 'var(--dthree-font-family-primary)',
                    'font_size' => 'var(--dthree-font-size-base)',
                    'font_weight' => '500',
                    'text_transform' => 'none',
                    'letter_spacing' => '0',
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
}

// Initialize the Design System
DThree_Design_System::get_instance();