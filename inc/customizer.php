<?php
/**
 * Theme Customizer
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add customizer settings
 */
function dthree_customize_register( $wp_customize ) {
    
    // Add DThree Settings Panel
    $wp_customize->add_panel( 'dthree_panel', array(
        'title'       => __( 'DThree Theme Options', 'dthree-gutenberg' ),
        'description' => __( 'Customize theme settings', 'dthree-gutenberg' ),
        'priority'    => 10,
    ) );

    // Header Section
    $wp_customize->add_section( 'dthree_header_section', array(
        'title'    => __( 'Header Settings', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 10,
    ) );

    // Sticky Header
    $wp_customize->add_setting( 'dthree_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_sticky_header', array(
        'label'    => __( 'Sticky Header', 'dthree-gutenberg' ),
        'section'  => 'dthree_header_section',
        'type'     => 'checkbox',
    ) );

    // Footer Section
    $wp_customize->add_section( 'dthree_footer_section', array(
        'title'    => __( 'Footer Settings', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 20,
    ) );

    // Footer Copyright Text
    $wp_customize->add_setting( 'dthree_footer_copyright', array(
        'default'           => sprintf( __( '© %s %s. All rights reserved.', 'dthree-gutenberg' ), date( 'Y' ), get_bloginfo( 'name' ) ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_footer_copyright', array(
        'label'    => __( 'Copyright Text', 'dthree-gutenberg' ),
        'section'  => 'dthree_footer_section',
        'type'     => 'text',
    ) );

    // Social Media Section
    $wp_customize->add_section( 'dthree_social_section', array(
        'title'    => __( 'Social Media Links', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 30,
    ) );

    // Social media links
    $social_networks = array(
        'facebook'  => __( 'Facebook URL', 'dthree-gutenberg' ),
        'twitter'   => __( 'Twitter URL', 'dthree-gutenberg' ),
        'instagram' => __( 'Instagram URL', 'dthree-gutenberg' ),
        'linkedin'  => __( 'LinkedIn URL', 'dthree-gutenberg' ),
        'youtube'   => __( 'YouTube URL', 'dthree-gutenberg' ),
        'github'    => __( 'GitHub URL', 'dthree-gutenberg' ),
        'tiktok'    => __( 'TikTok URL', 'dthree-gutenberg' ),
        'pinterest' => __( 'Pinterest URL', 'dthree-gutenberg' ),
        'whatsapp'  => __( 'WhatsApp URL', 'dthree-gutenberg' ),
        'telegram'  => __( 'Telegram URL', 'dthree-gutenberg' ),
        'discord'   => __( 'Discord URL', 'dthree-gutenberg' ),
        'snapchat'  => __( 'Snapchat URL', 'dthree-gutenberg' ),
        'reddit'    => __( 'Reddit URL', 'dthree-gutenberg' ),
        'medium'    => __( 'Medium URL', 'dthree-gutenberg' ),
        'twitch'    => __( 'Twitch URL', 'dthree-gutenberg' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting( 'dthree_social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dthree_social_' . $network, array(
            'label'    => $label,
            'section'  => 'dthree_social_section',
            'type'     => 'url',
        ) );
    }

    // Layout Section
    $wp_customize->add_section( 'dthree_layout_section', array(
        'title'    => __( 'Layout Settings', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 40,
    ) );

    // Container Width
    $wp_customize->add_setting( 'dthree_container_width', array(
        'default'           => '1140',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_container_width', array(
        'label'       => __( 'Container Width (px)', 'dthree-gutenberg' ),
        'description' => __( 'Maximum width for content container', 'dthree-gutenberg' ),
        'section'     => 'dthree_layout_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 960,
            'max'  => 1920,
            'step' => 20,
        ),
    ) );

    // Typography Section
    $wp_customize->add_section( 'dthree_typography_section', array(
        'title'    => __( 'Typography', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 50,
    ) );

    // Base Font Size
    $wp_customize->add_setting( 'dthree_base_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_base_font_size', array(
        'label'       => __( 'Base Font Size (px)', 'dthree-gutenberg' ),
        'section'     => 'dthree_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ) );

    // Performance Section
    $wp_customize->add_section( 'dthree_performance_section', array(
        'title'    => __( 'Performance', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 60,
    ) );

    // Enable animations
    $wp_customize->add_setting( 'dthree_enable_animations', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_enable_animations', array(
        'label'       => __( 'Enable Scroll Animations', 'dthree-gutenberg' ),
        'description' => __( 'Enable AOS (Animate On Scroll) library', 'dthree-gutenberg' ),
        'section'     => 'dthree_performance_section',
        'type'        => 'checkbox',
    ) );

    // SEO Section
    $wp_customize->add_section( 'dthree_seo_section', array(
        'title'    => __( 'SEO Settings', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 70,
    ) );

    // Enable Schema.org markup
    $wp_customize->add_setting( 'dthree_enable_schema', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'dthree_enable_schema', array(
        'label'       => __( 'Enable Schema.org Markup', 'dthree-gutenberg' ),
        'description' => __( 'Add structured data for better SEO', 'dthree-gutenberg' ),
        'section'     => 'dthree_seo_section',
        'type'        => 'checkbox',
    ) );
    
    // Content Settings Section
    $wp_customize->add_section( 'dthree_content_section', array(
        'title'    => __( 'Content Settings', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 75,
    ) );
    
    // Enable Table of Contents
    $wp_customize->add_setting( 'dthree_enable_toc', array(
        'default'           => false,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dthree_enable_toc', array(
        'label'       => __( 'Enable Table of Contents', 'dthree-gutenberg' ),
        'description' => __( 'Auto-generate TOC for blog posts with 3+ headings', 'dthree-gutenberg' ),
        'section'     => 'dthree_content_section',
        'type'        => 'checkbox',
    ) );
    
    // Enable Reading Time
    $wp_customize->add_setting( 'dthree_show_reading_time', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dthree_show_reading_time', array(
        'label'       => __( 'Show Reading Time', 'dthree-gutenberg' ),
        'description' => __( 'Display estimated reading time on blog posts', 'dthree-gutenberg' ),
        'section'     => 'dthree_content_section',
        'type'        => 'checkbox',
    ) );
    
    // Enable Related Posts
    $wp_customize->add_setting( 'dthree_show_related_posts', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dthree_show_related_posts', array(
        'label'       => __( 'Show Related Posts', 'dthree-gutenberg' ),
        'description' => __( 'Display related posts at the end of blog posts', 'dthree-gutenberg' ),
        'section'     => 'dthree_content_section',
        'type'        => 'checkbox',
    ) );
    
    // Privacy Section
    $wp_customize->add_section( 'dthree_privacy_section', array(
        'title'    => __( 'Privacy & Compliance', 'dthree-gutenberg' ),
        'panel'    => 'dthree_panel',
        'priority' => 80,
    ) );
    
    // Enable Cookie Consent
    $wp_customize->add_setting( 'dthree_enable_cookie_consent', array(
        'default'           => true,
        'sanitize_callback' => 'dthree_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dthree_enable_cookie_consent', array(
        'label'       => __( 'Enable Cookie Consent Notice', 'dthree-gutenberg' ),
        'description' => __( 'Show GDPR-compliant cookie consent banner', 'dthree-gutenberg' ),
        'section'     => 'dthree_privacy_section',
        'type'        => 'checkbox',
    ) );
    
    // Cookie Consent Text
    $wp_customize->add_setting( 'dthree_cookie_consent_text', array(
        'default'           => __( 'We use cookies to ensure you get the best experience on our website. By continuing to browse, you agree to our use of cookies.', 'dthree-gutenberg' ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'dthree_cookie_consent_text', array(
        'label'       => __( 'Cookie Consent Message', 'dthree-gutenberg' ),
        'section'     => 'dthree_privacy_section',
        'type'        => 'textarea',
    ) );
}
add_action( 'customize_register', 'dthree_customize_register' );

/**
 * Sanitize checkbox
 */
function dthree_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Output customizer styles
 */
function dthree_customizer_css() {
    $container_width = get_theme_mod( 'dthree_container_width', '1140' );
    $base_font_size  = get_theme_mod( 'dthree_base_font_size', '16' );
    ?>
    <style type="text/css">
        .container {
            max-width: <?php echo absint( $container_width ); ?>px;
        }
        body {
            font-size: <?php echo absint( $base_font_size ); ?>px;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'dthree_customizer_css' );

/**
 * Get social media links
 */
function dthree_get_social_links() {
    $social_networks = array(
        'facebook'  => array(
            'icon'  => 'bi-facebook',
            'label' => __( 'Facebook', 'dthree-gutenberg' ),
        ),
        'twitter'   => array(
            'icon'  => 'bi-twitter',
            'label' => __( 'Twitter', 'dthree-gutenberg' ),
        ),
        'instagram' => array(
            'icon'  => 'bi-instagram',
            'label' => __( 'Instagram', 'dthree-gutenberg' ),
        ),
        'linkedin'  => array(
            'icon'  => 'bi-linkedin',
            'label' => __( 'LinkedIn', 'dthree-gutenberg' ),
        ),
        'youtube'   => array(
            'icon'  => 'bi-youtube',
            'label' => __( 'YouTube', 'dthree-gutenberg' ),
        ),
        'github'    => array(
            'icon'  => 'bi-github',
            'label' => __( 'GitHub', 'dthree-gutenberg' ),
        ),
        'tiktok'    => array(
            'icon'  => 'bi-tiktok',
            'label' => __( 'TikTok', 'dthree-gutenberg' ),
        ),
        'pinterest' => array(
            'icon'  => 'bi-pinterest',
            'label' => __( 'Pinterest', 'dthree-gutenberg' ),
        ),
        'whatsapp'  => array(
            'icon'  => 'bi-whatsapp',
            'label' => __( 'WhatsApp', 'dthree-gutenberg' ),
        ),
        'telegram'  => array(
            'icon'  => 'bi-telegram',
            'label' => __( 'Telegram', 'dthree-gutenberg' ),
        ),
        'discord'   => array(
            'icon'  => 'bi-discord',
            'label' => __( 'Discord', 'dthree-gutenberg' ),
        ),
        'snapchat'  => array(
            'icon'  => 'bi-snapchat',
            'label' => __( 'Snapchat', 'dthree-gutenberg' ),
        ),
        'reddit'    => array(
            'icon'  => 'bi-reddit',
            'label' => __( 'Reddit', 'dthree-gutenberg' ),
        ),
        'medium'    => array(
            'icon'  => 'bi-medium',
            'label' => __( 'Medium', 'dthree-gutenberg' ),
        ),
        'twitch'    => array(
            'icon'  => 'bi-twitch',
            'label' => __( 'Twitch', 'dthree-gutenberg' ),
        ),
    );

    $links = array();
    foreach ( $social_networks as $network => $data ) {
        $url = get_theme_mod( 'dthree_social_' . $network, '' );
        if ( ! empty( $url ) ) {
            $links[ $network ] = array(
                'url'   => esc_url( $url ),
                'icon'  => $data['icon'],
                'label' => $data['label'],
            );
        }
    }

    return $links;
}

/**
 * Display social media links
 */
function dthree_display_social_links( $args = array() ) {
    $defaults = array(
        'show_labels' => false,
        'size'        => 'normal', // small, normal, large
        'style'       => 'default', // default, rounded, square
        'class'       => '',
    );
    
    $args = wp_parse_args( $args, $defaults );
    $social_links = dthree_get_social_links();
    
    if ( empty( $social_links ) ) {
        return;
    }
    
    $size_class = '';
    switch ( $args['size'] ) {
        case 'small':
            $size_class = 'fs-6';
            break;
        case 'large':
            $size_class = 'fs-3';
            break;
        default:
            $size_class = 'fs-5';
    }
    
    $style_class = '';
    switch ( $args['style'] ) {
        case 'rounded':
            $style_class = 'rounded-circle';
            break;
        case 'square':
            $style_class = 'rounded-1';
            break;
    }
    
    echo '<div class="dthree-social-links ' . esc_attr( $args['class'] ) . '">';
    
    foreach ( $social_links as $network => $data ) {
        $label = $args['show_labels'] ? '<span class="ms-2">' . esc_html( $data['label'] ) . '</span>' : '';
        
        printf(
            '<a href="%s" class="social-link social-link-%s text-decoration-none me-3 %s %s" target="_blank" rel="noopener noreferrer" aria-label="%s">
                <i class="bi %s %s"></i>%s
            </a>',
            esc_url( $data['url'] ),
            esc_attr( $network ),
            esc_attr( $size_class ),
            esc_attr( $style_class ),
            esc_attr( $data['label'] ),
            esc_attr( $data['icon'] ),
            esc_attr( $size_class ),
            $label
        );
    }
    
    echo '</div>';
}

