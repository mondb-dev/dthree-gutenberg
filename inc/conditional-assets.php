<?php
/**
 * Conditional Asset Loading
 * Only load scripts and styles when blocks are actually used
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Conditionally enqueue assets based on block usage
 */
function dthree_conditional_enqueue_assets() {
    if ( is_admin() ) {
        return;
    }
    
    global $post;
    
    if ( ! $post ) {
        return;
    }
    
    // Check if any slider blocks are used
    $has_sliders = has_block( 'dthree/image-slider', $post ) ||
                   has_block( 'dthree/content-slider', $post ) ||
                   has_block( 'dthree/logo-slider', $post ) ||
                   has_block( 'dthree/card-slider', $post ) ||
                   has_block( 'dthree/testimonial-slider', $post );
    
    if ( $has_sliders ) {
        wp_enqueue_style(
            'dthree-sliders',
            DTHREE_THEME_URI . '/assets/css/sliders.css',
            array( 'dthree-style' ),
            DTHREE_VERSION
        );
    }
    
    // Check if component blocks are used
    $has_components = has_block( 'dthree/tabs', $post ) ||
                      has_block( 'dthree/accordion', $post ) ||
                      has_block( 'dthree/pricing-tables', $post ) ||
                      has_block( 'dthree/progress-bars', $post ) ||
                      has_block( 'dthree/timeline', $post ) ||
                      has_block( 'dthree/modal', $post ) ||
                      has_block( 'dthree/video-player', $post ) ||
                      has_block( 'dthree/alerts', $post ) ||
                      has_block( 'dthree/icon-boxes', $post ) ||
                      has_block( 'dthree/social-share', $post ) ||
                      has_block( 'dthree/data-table', $post );
    
    if ( $has_components ) {
        wp_enqueue_style(
            'dthree-components',
            DTHREE_THEME_URI . '/assets/css/components.css',
            array( 'dthree-style' ),
            DTHREE_VERSION
        );
    }
    
    // Check if charts block is used
    if ( has_block( 'dthree/charts', $post ) ) {
        wp_enqueue_script(
            'chartjs',
            'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
            array(),
            '4.4.0',
            true
        );
    }
    
    // Check if lightbox is needed (images in content, galleries, etc.)
    if ( has_block( 'core/image', $post ) || 
         has_block( 'core/gallery', $post ) ||
         has_post_thumbnail( $post ) ) {
        wp_enqueue_style(
            'dthree-lightbox',
            DTHREE_THEME_URI . '/assets/css/lightbox.css',
            array( 'dthree-style' ),
            DTHREE_VERSION
        );
        
        wp_enqueue_script(
            'dthree-lightbox',
            DTHREE_THEME_URI . '/assets/js/lightbox.js',
            array(),
            DTHREE_VERSION,
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'dthree_conditional_enqueue_assets', 20 );

/**
 * Remove globally enqueued assets that are now conditional
 */
function dthree_remove_global_conditional_assets() {
    // This runs after the main enqueue to dequeue conditionally loaded assets
    // They will be re-enqueued by dthree_conditional_enqueue_assets if needed
    
    if ( ! is_admin() ) {
        global $post;
        
        // Always keep these dequeued, let conditional loading handle them
        wp_dequeue_style( 'dthree-sliders' );
        wp_dequeue_style( 'dthree-components' );
        wp_dequeue_style( 'dthree-lightbox' );
        wp_dequeue_script( 'dthree-lightbox' );
    }
}
add_action( 'wp_enqueue_scripts', 'dthree_remove_global_conditional_assets', 15 );
