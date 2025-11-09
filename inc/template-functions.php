<?php
/**
 * Template Functions
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Bootstrap Navigation Walker
 * Custom walker class for Bootstrap 5 navigation
 */
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        
        if ( in_array( 'menu-item-has-children', $classes, true ) ) {
            $classes[] = 'dropdown';
        }
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        
        $atts['class'] = 'nav-link';
        
        if ( in_array( 'current-menu-item', $classes, true ) ) {
            $atts['class'] .= ' active';
            $atts['aria-current'] = 'page';
        }
        
        if ( in_array( 'menu-item-has-children', $classes, true ) ) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['role'] = 'button';
            $atts['aria-expanded'] = 'false';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Custom excerpt length
 */
function dthree_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'dthree_excerpt_length' );

/**
 * Custom excerpt more
 */
function dthree_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'dthree_excerpt_more' );

/**
 * Add custom body classes
 */
function dthree_body_classes( $classes ) {
    // Add page slug to body class
    if ( is_singular() ) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class for sidebar
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'dthree_body_classes' );

/**
 * Custom pagination
 */
function dthree_pagination() {
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    // Add current page to the array
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    // Add the pages around the current page to the array
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination-nav" aria-label="' . esc_attr__( 'Posts navigation', 'dthree-gutenberg' ) . '"><ul class="pagination justify-content-center">';

    // Previous Post Link
    if ( get_previous_posts_link() ) {
        printf( '<li class="page-item">%s</li>', get_previous_posts_link( __( '&laquo; Previous', 'dthree-gutenberg' ) ) );
    }

    // Link to first page, plus ellipses if necessary
    if ( ! in_array( 1, $links, true ) ) {
        $class = 1 === $paged ? ' active' : '';
        printf( '<li class="page-item%s"><a class="page-link" href="%s">%s</a></li>', esc_attr( $class ), esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links, true ) ) {
            echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
        }
    }

    // Link to current page, plus 2 pages in either direction if necessary
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged === $link ? ' active' : '';
        printf( '<li class="page-item%s"><a class="page-link" href="%s">%s</a></li>', esc_attr( $class ), esc_url( get_pagenum_link( $link ) ), esc_html( $link ) );
    }

    // Link to last page, plus ellipses if necessary
    if ( ! in_array( $max, $links, true ) ) {
        if ( ! in_array( $max - 1, $links, true ) ) {
            echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
        }

        $class = $paged === $max ? ' active' : '';
        printf( '<li class="page-item%s"><a class="page-link" href="%s">%s</a></li>', esc_attr( $class ), esc_url( get_pagenum_link( $max ) ), esc_html( $max ) );
    }

    // Next Post Link
    if ( get_next_posts_link() ) {
        printf( '<li class="page-item">%s</li>', get_next_posts_link( __( 'Next &raquo;', 'dthree-gutenberg' ) ) );
    }

    echo '</ul></nav>';
}

/**
 * Get estimated reading time
 */
function dthree_get_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average reading speed: 200 words per minute
    
    return sprintf(
        /* translators: %s: Reading time in minutes */
        _n( '%s min read', '%s min read', $reading_time, 'dthree-gutenberg' ),
        number_format_i18n( $reading_time )
    );
}

/**
 * Display breadcrumbs
 */
function dthree_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav aria-label="' . esc_attr__( 'Breadcrumb', 'dthree-gutenberg' ) . '">';
    echo '<ol class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'dthree-gutenberg' ) . '</a></li>';

    if ( is_category() || is_single() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></li>';
        }
        if ( is_single() ) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
        }
    } elseif ( is_page() ) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
    } elseif ( is_search() ) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__( 'Search Results', 'dthree-gutenberg' ) . '</li>';
    } elseif ( is_404() ) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__( '404 Not Found', 'dthree-gutenberg' ) . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Breadcrumb shortcode
 */
function dthree_breadcrumb_shortcode( $atts ) {
    ob_start();
    dthree_breadcrumbs();
    return ob_get_clean();
}
add_shortcode( 'breadcrumbs', 'dthree_breadcrumb_shortcode' );

/**
 * Social Media Share Buttons for Posts
 */
function dthree_social_share_buttons() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    
    $post_url = urlencode( get_permalink() );
    $post_title = urlencode( get_the_title() );
    
    ?>
    <div class="dthree-social-share mt-4 mb-4">
        <h6 class="mb-3"><?php esc_html_e( 'Share this post:', 'dthree-gutenberg' ); ?></h6>
        <div class="d-flex flex-wrap gap-2">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" 
               class="btn btn-sm btn-outline-primary" 
               target="_blank" 
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e( 'Share on Facebook', 'dthree-gutenberg' ); ?>">
                <i class="bi bi-facebook me-1"></i>
                <?php esc_html_e( 'Facebook', 'dthree-gutenberg' ); ?>
            </a>
            
            <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" 
               class="btn btn-sm btn-outline-info" 
               target="_blank" 
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e( 'Share on Twitter', 'dthree-gutenberg' ); ?>">
                <i class="bi bi-twitter me-1"></i>
                <?php esc_html_e( 'Twitter', 'dthree-gutenberg' ); ?>
            </a>
            
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" 
               class="btn btn-sm btn-outline-primary" 
               target="_blank" 
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'dthree-gutenberg' ); ?>">
                <i class="bi bi-linkedin me-1"></i>
                <?php esc_html_e( 'LinkedIn', 'dthree-gutenberg' ); ?>
            </a>
            
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&description=<?php echo $post_title; ?>" 
               class="btn btn-sm btn-outline-danger" 
               target="_blank" 
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e( 'Share on Pinterest', 'dthree-gutenberg' ); ?>">
                <i class="bi bi-pinterest me-1"></i>
                <?php esc_html_e( 'Pinterest', 'dthree-gutenberg' ); ?>
            </a>
            
            <a href="https://api.whatsapp.com/send?text=<?php echo $post_title . ' ' . $post_url; ?>" 
               class="btn btn-sm btn-outline-success" 
               target="_blank" 
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'dthree-gutenberg' ); ?>">
                <i class="bi bi-whatsapp me-1"></i>
                <?php esc_html_e( 'WhatsApp', 'dthree-gutenberg' ); ?>
            </a>
        </div>
    </div>
    <?php
}

