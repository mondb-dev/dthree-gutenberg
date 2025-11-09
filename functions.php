<?php
/**
 * DThree Gutenberg Theme Functions
 *
 * @package DThree_Gutenberg
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'DTHREE_VERSION', '1.2.0' );
define( 'DTHREE_THEME_DIR', get_template_directory() );
define( 'DTHREE_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function dthree_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'dthree-gutenberg', DTHREE_THEME_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 630, true );
    
    // Add custom image sizes
    add_image_size( 'dthree-hero', 1920, 1080, true );
    add_image_size( 'dthree-featured', 800, 600, true );
    add_image_size( 'dthree-thumbnail', 400, 300, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'dthree-gutenberg' ),
        'footer'  => esc_html__( 'Footer Menu', 'dthree-gutenberg' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for custom header
    add_theme_support( 'custom-header', array(
        'default-image'      => '',
        'width'              => 1920,
        'height'             => 400,
        'flex-height'        => true,
        'flex-width'         => true,
        'header-text'        => true,
        'default-text-color' => '000000',
    ) );

    // Add support for custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for wide and full alignments
    add_theme_support( 'align-wide' );

    // Add support for block styles
    add_theme_support( 'wp-block-styles' );

    // Disable the block editor for widgets (optional - remove if you want block widgets)
    // remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'dthree_setup' );

/**
 * Set the content width
 */
function dthree_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'dthree_content_width', 1200 );
}
add_action( 'after_setup_theme', 'dthree_content_width', 0 );

/**
 * Enqueue scripts and styles
 */
function dthree_enqueue_scripts() {
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array(),
        '5.3.2'
    );

    // Theme stylesheet
    wp_enqueue_style(
        'dthree-style',
        get_stylesheet_uri(),
        array( 'bootstrap' ),
        DTHREE_VERSION
    );

    // Custom theme styles
    wp_enqueue_style(
        'dthree-custom',
        DTHREE_THEME_URI . '/assets/css/custom.css',
        array( 'dthree-style' ),
        DTHREE_VERSION
    );
    
    // Print stylesheet
    wp_enqueue_style(
        'dthree-print',
        DTHREE_THEME_URI . '/assets/css/print.css',
        array(),
        DTHREE_VERSION,
        'print'
    );
    
    // Slider components styles
    wp_enqueue_style(
        'dthree-sliders',
        DTHREE_THEME_URI . '/assets/css/sliders.css',
        array( 'dthree-style' ),
        DTHREE_VERSION
    );
    
    // Lightbox styles
    wp_enqueue_style(
        'dthree-lightbox',
        DTHREE_THEME_URI . '/assets/css/lightbox.css',
        array( 'dthree-style' ),
        DTHREE_VERSION
    );
    
    // Component blocks styles
    wp_enqueue_style(
        'dthree-components',
        DTHREE_THEME_URI . '/assets/css/components.css',
        array( 'dthree-style' ),
        DTHREE_VERSION
    );

    // Bootstrap JS Bundle (includes Popper)
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );

    // Lightbox JavaScript
    wp_enqueue_script(
        'dthree-lightbox',
        DTHREE_THEME_URI . '/assets/js/lightbox.js',
        array(),
        DTHREE_VERSION,
        true
    );
    
    // Theme JavaScript
    wp_enqueue_script(
        'dthree-main',
        DTHREE_THEME_URI . '/assets/js/main.js',
        array( 'bootstrap', 'dthree-lightbox' ),
        DTHREE_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script( 'dthree-main', 'dthreeData', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'dthree-nonce' ),
        'siteUrl' => home_url( '/' ),
    ) );

    // Comments reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'dthree_enqueue_scripts' );

/**
 * Enqueue block editor assets
 */
function dthree_enqueue_block_editor_assets() {
    // Bootstrap in editor
    wp_enqueue_style(
        'dthree-editor-bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array(),
        '5.3.2'
    );

    // Editor styles
    wp_enqueue_style(
        'dthree-editor-style',
        DTHREE_THEME_URI . '/assets/css/editor-style.css',
        array( 'dthree-editor-bootstrap' ),
        DTHREE_VERSION
    );

    // Block editor script
    wp_enqueue_script(
        'dthree-editor',
        DTHREE_THEME_URI . '/assets/js/editor.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        DTHREE_VERSION,
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'dthree_enqueue_block_editor_assets' );

/**
 * Register widget areas
 */
function dthree_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'dthree-gutenberg' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'dthree-gutenberg' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title h5 mb-3">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'dthree-gutenberg' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Footer widget area 1', 'dthree-gutenberg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title h6 mb-3">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'dthree-gutenberg' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Footer widget area 2', 'dthree-gutenberg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title h6 mb-3">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'dthree-gutenberg' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Footer widget area 3', 'dthree-gutenberg' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title h6 mb-3">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'dthree_widgets_init' );

/**
 * Add SEO meta tags
 */
function dthree_add_seo_meta() {
    if ( is_singular() ) {
        global $post;
        
        // Description
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30 );
        $description = wp_strip_all_tags( $description );
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";
        
        if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumbnail ) {
                echo '<meta property="og:image" content="' . esc_url( $thumbnail[0] ) . '">' . "\n";
            }
        }
        
        // Twitter Card tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'dthree_add_seo_meta' );

/**
 * Add Schema.org markup
 */
function dthree_add_schema_markup() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
            ),
        );
        
        if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumbnail ) {
                $schema['image'] = $thumbnail[0];
            }
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'dthree_add_schema_markup' );

/**
 * Security: Remove WordPress version from head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Security: Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Security: Remove RSD link
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Security: Remove Windows Live Writer link
 */
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Include custom blocks
 */
require_once DTHREE_THEME_DIR . '/inc/blocks/hero-section.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/features.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/call-to-action.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/team-members.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/testimonials.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/contact-form.php';

/**
 * Include slider blocks
 */
require_once DTHREE_THEME_DIR . '/inc/blocks/image-slider.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/content-slider.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/logo-slider.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/card-slider.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/testimonial-slider.php';

/**
 * Include component blocks
 */
require_once DTHREE_THEME_DIR . '/inc/blocks/tabs.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/accordion.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/pricing-tables.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/progress-bars.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/timeline.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/modal.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/video-player.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/alerts.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/icon-boxes.php';
require_once DTHREE_THEME_DIR . '/inc/blocks/social-share.php';

/**
 * Include template functions
 */
require_once DTHREE_THEME_DIR . '/inc/template-functions.php';

/**
 * Include customizer options
 */
require_once DTHREE_THEME_DIR . '/inc/customizer.php';

/**
 * Include security functions
 */
require_once DTHREE_THEME_DIR . '/inc/security.php';

/**
 * Include Design System
 */
require_once DTHREE_THEME_DIR . '/inc/design-system.php';

/**
 * Include theme enhancements
 */
require_once DTHREE_THEME_DIR . '/inc/enhancements.php';

/**
 * Include lightbox functionality
 */
require_once DTHREE_THEME_DIR . '/inc/lightbox.php';

/**
 * Include advanced SEO features
 */
require_once DTHREE_THEME_DIR . '/inc/seo.php';

/**
 * Include AI-friendly features
 */
require_once DTHREE_THEME_DIR . '/inc/ai-features.php';
