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
