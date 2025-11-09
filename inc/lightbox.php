<?php
/**
 * Lightbox Helper Functions
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add lightbox to image
 * 
 * @param string $html The image HTML
 * @param int    $attachment_id The attachment ID
 * @return string Modified HTML
 */
function dthree_add_lightbox_to_image( $html, $attachment_id ) {
    $full_image = wp_get_attachment_image_src( $attachment_id, 'full' );
    $caption = wp_get_attachment_caption( $attachment_id );
    
    if ( $full_image ) {
        $html = str_replace( '<img', '<img data-lightbox="true" data-full-url="' . esc_url( $full_image[0] ) . '" data-caption="' . esc_attr( $caption ) . '"', $html );
    }
    
    return $html;
}

/**
 * Enable lightbox for WordPress galleries
 */
function dthree_enable_gallery_lightbox() {
    add_filter( 'wp_get_attachment_image_attributes', function( $attr, $attachment ) {
        if ( ! isset( $attr['data-lightbox'] ) ) {
            $full_image = wp_get_attachment_image_src( $attachment->ID, 'full' );
            $caption = wp_get_attachment_caption( $attachment->ID );
            
            if ( $full_image ) {
                $attr['data-full-url'] = $full_image[0];
                $attr['data-caption'] = $caption;
            }
        }
        return $attr;
    }, 10, 2 );
}
add_action( 'init', 'dthree_enable_gallery_lightbox' );

/**
 * Add lightbox to post content images
 *
 * @param string $content The post content
 * @return string Modified content
 */
function dthree_add_lightbox_to_content_images( $content ) {
    // Skip if in admin or feed
    if ( is_admin() || is_feed() ) {
        return $content;
    }
    
    // Add data-lightbox to images in content
    $content = preg_replace_callback( '/<img([^>]+)>/i', function( $matches ) {
        $img = $matches[0];
        
        // Skip if already has lightbox
        if ( strpos( $img, 'data-lightbox' ) !== false ) {
            return $img;
        }
        
        // Skip if has 'no-lightbox' class
        if ( strpos( $img, 'no-lightbox' ) !== false ) {
            return $img;
        }
        
        // Add lightbox attribute
        $img = str_replace( '<img', '<img data-lightbox="true"', $img );
        
        return $img;
    }, $content );
    
    return $content;
}
add_filter( 'the_content', 'dthree_add_lightbox_to_content_images', 20 );

/**
 * Lightbox shortcode
 * Usage: [lightbox src="image.jpg" caption="My Image"]
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function dthree_lightbox_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'src'     => '',
        'thumb'   => '',
        'caption' => '',
        'alt'     => '',
        'class'   => '',
    ), $atts );
    
    if ( empty( $atts['src'] ) ) {
        return '';
    }
    
    $thumb_src = ! empty( $atts['thumb'] ) ? $atts['thumb'] : $atts['src'];
    $alt_text = ! empty( $atts['alt'] ) ? $atts['alt'] : $atts['caption'];
    $class = 'dthree-lightbox-trigger ' . $atts['class'];
    
    return sprintf(
        '<img src="%s" alt="%s" class="%s" data-lightbox="true" data-full-url="%s" data-caption="%s" />',
        esc_url( $thumb_src ),
        esc_attr( $alt_text ),
        esc_attr( $class ),
        esc_url( $atts['src'] ),
        esc_attr( $atts['caption'] )
    );
}
add_shortcode( 'lightbox', 'dthree_lightbox_shortcode' );

/**
 * Lightbox gallery shortcode
 * Usage: [lightbox_gallery ids="1,2,3,4"]
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function dthree_lightbox_gallery_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'ids'     => '',
        'columns' => 3,
        'size'    => 'medium',
    ), $atts );
    
    if ( empty( $atts['ids'] ) ) {
        return '';
    }
    
    $ids = array_map( 'trim', explode( ',', $atts['ids'] ) );
    $columns = absint( $atts['columns'] );
    
    $output = '<div class="dthree-lightbox-gallery row g-3">';
    
    foreach ( $ids as $id ) {
        $image = wp_get_attachment_image_src( $id, $atts['size'] );
        $full = wp_get_attachment_image_src( $id, 'full' );
        $caption = wp_get_attachment_caption( $id );
        $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
        
        if ( $image && $full ) {
            $col_class = 'col-12 col-sm-6 col-md-' . ( 12 / $columns );
            
            $output .= sprintf(
                '<div class="%s"><img src="%s" alt="%s" class="img-fluid dthree-lightbox-trigger" data-lightbox="true" data-full-url="%s" data-caption="%s" /></div>',
                esc_attr( $col_class ),
                esc_url( $image[0] ),
                esc_attr( $alt ),
                esc_url( $full[0] ),
                esc_attr( $caption )
            );
        }
    }
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode( 'lightbox_gallery', 'dthree_lightbox_gallery_shortcode' );

/**
 * Add lightbox support to featured images
 *
 * @param string $html The post thumbnail HTML
 * @param int    $post_id Post ID
 * @param int    $post_thumbnail_id Thumbnail attachment ID
 * @return string Modified HTML
 */
function dthree_add_lightbox_to_featured_image( $html, $post_id, $post_thumbnail_id ) {
    $full_image = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
    $caption = wp_get_attachment_caption( $post_thumbnail_id );
    
    if ( $full_image ) {
        $html = str_replace(
            '<img',
            '<img data-lightbox="true" data-full-url="' . esc_url( $full_image[0] ) . '" data-caption="' . esc_attr( $caption ) . '" style="cursor: pointer;"',
            $html
        );
    }
    
    return $html;
}
// Uncomment to enable lightbox on featured images
// add_filter( 'post_thumbnail_html', 'dthree_add_lightbox_to_featured_image', 10, 3 );

/**
 * Helper function to create lightbox image HTML
 *
 * @param int    $attachment_id Attachment ID
 * @param string $size Image size
 * @param array  $attr Additional attributes
 * @return string Image HTML
 */
function dthree_get_lightbox_image( $attachment_id, $size = 'large', $attr = array() ) {
    $full_image = wp_get_attachment_image_src( $attachment_id, 'full' );
    $caption = wp_get_attachment_caption( $attachment_id );
    
    if ( ! isset( $attr['data-lightbox'] ) ) {
        $attr['data-lightbox'] = 'true';
    }
    
    if ( $full_image && ! isset( $attr['data-full-url'] ) ) {
        $attr['data-full-url'] = $full_image[0];
    }
    
    if ( $caption && ! isset( $attr['data-caption'] ) ) {
        $attr['data-caption'] = $caption;
    }
    
    if ( ! isset( $attr['class'] ) ) {
        $attr['class'] = 'dthree-lightbox-trigger';
    } else {
        $attr['class'] .= ' dthree-lightbox-trigger';
    }
    
    return wp_get_attachment_image( $attachment_id, $size, false, $attr );
}
