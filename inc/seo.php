<?php
/**
 * Advanced SEO Features
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add comprehensive meta tags
 */
function dthree_seo_meta_tags() {
    if ( is_singular() ) {
        global $post;
        
        // Get post data
        $title = get_the_title();
        $description = dthree_get_meta_description();
        $url = get_permalink();
        $image = dthree_get_featured_image_url();
        $author = get_the_author_meta( 'display_name', $post->post_author );
        $published = get_the_date( 'c' );
        $modified = get_the_modified_date( 'c' );
        
        // Canonical URL
        echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
        
        // Meta description
        if ( $description ) {
            echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        }
        
        // Open Graph tags
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
        
        if ( $image ) {
            echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
            echo '<meta property="og:image:width" content="1200">' . "\n";
            echo '<meta property="og:image:height" content="630">' . "\n";
        }
        
        // Twitter Card tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
        
        if ( $image ) {
            echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
        }
        
        // Article tags
        echo '<meta property="article:published_time" content="' . esc_attr( $published ) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( $modified ) . '">' . "\n";
        echo '<meta property="article:author" content="' . esc_attr( $author ) . '">' . "\n";
        
        // Categories and tags
        $categories = get_the_category();
        foreach ( $categories as $category ) {
            echo '<meta property="article:section" content="' . esc_attr( $category->name ) . '">' . "\n";
        }
        
        $tags = get_the_tags();
        if ( $tags ) {
            foreach ( $tags as $tag ) {
                echo '<meta property="article:tag" content="' . esc_attr( $tag->name ) . '">' . "\n";
            }
        }
        
    } elseif ( is_home() || is_front_page() ) {
        $description = get_bloginfo( 'description' );
        $url = home_url( '/' );
        
        echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'dthree_seo_meta_tags', 1 );

/**
 * Get optimized meta description
 */
function dthree_get_meta_description() {
    if ( is_singular() ) {
        // Try manual excerpt first
        if ( has_excerpt() ) {
            return wp_trim_words( get_the_excerpt(), 30, '...' );
        }
        
        // Generate from content
        $content = get_the_content();
        $content = wp_strip_all_tags( $content );
        $content = preg_replace( '/\s+/', ' ', $content );
        return wp_trim_words( $content, 30, '...' );
    }
    
    return get_bloginfo( 'description' );
}

/**
 * Get featured image URL for meta tags
 */
function dthree_get_featured_image_url() {
    if ( has_post_thumbnail() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        return $image[0];
    }
    
    // Fallback to first image in content
    global $post;
    $content = $post->post_content;
    preg_match( '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $matches );
    
    if ( ! empty( $matches[1] ) ) {
        return $matches[1];
    }
    
    return '';
}

/**
 * Add JSON-LD structured data
 */
function dthree_json_ld_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        
        $schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'description'   => dthree_get_meta_description(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => array(
                '@type' => 'Person',
                'name'  => get_the_author_meta( 'display_name', $post->post_author ),
                'url'   => get_author_posts_url( $post->post_author ),
            ),
            'publisher'     => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo( 'name' ),
                'url'   => home_url( '/' ),
            ),
        );
        
        // Add image
        $image = dthree_get_featured_image_url();
        if ( $image ) {
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url'   => $image,
            );
        }
        
        // Add main entity of page
        $schema['mainEntityOfPage'] = array(
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        );
        
        // Word count
        $content = get_the_content();
        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $schema['wordCount'] = $word_count;
        
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo '</script>' . "\n";
        
    } elseif ( is_singular( 'page' ) ) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            'name'        => get_the_title(),
            'description' => dthree_get_meta_description(),
            'url'         => get_permalink(),
        );
        
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo '</script>' . "\n";
        
    } elseif ( is_home() || is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => get_bloginfo( 'name' ),
            'url'      => home_url( '/' ),
            'description' => get_bloginfo( 'description' ),
        );
        
        // Add search action
        $schema['potentialAction'] = array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'       => 'EntryPoint',
                'urlTemplate' => home_url( '/?s={search_term_string}' ),
            ),
            'query-input' => 'required name=search_term_string',
        );
        
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo '</script>' . "\n";
    }
    
    // Add organization schema on all pages
    dthree_organization_schema();
}
add_action( 'wp_head', 'dthree_json_ld_schema', 2 );

/**
 * Organization schema
 */
function dthree_organization_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => get_bloginfo( 'name' ),
        'url'      => home_url( '/' ),
    );
    
    // Add logo if custom logo is set
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $custom_logo_id ) {
        $logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        $schema['logo'] = $logo_url;
    }
    
    // Add social profiles if set in customizer
    $social_profiles = array();
    $social_networks = array( 'facebook', 'twitter', 'linkedin', 'instagram', 'youtube' );
    
    foreach ( $social_networks as $network ) {
        $url = get_theme_mod( 'dthree_social_' . $network );
        if ( $url ) {
            $social_profiles[] = $url;
        }
    }
    
    if ( ! empty( $social_profiles ) ) {
        $schema['sameAs'] = $social_profiles;
    }
    
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
    echo '</script>' . "\n";
}

/**
 * Add breadcrumb schema
 */
function dthree_breadcrumb_schema() {
    if ( is_singular() && ! is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => array(),
        );
        
        // Home
        $schema['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => home_url( '/' ),
        );
        
        $position = 2;
        
        // Add category for posts
        if ( is_single() ) {
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $category = $categories[0];
                $schema['itemListElement'][] = array(
                    '@type'    => 'ListItem',
                    'position' => $position,
                    'name'     => $category->name,
                    'item'     => get_category_link( $category->term_id ),
                );
                $position++;
            }
        }
        
        // Current page
        $schema['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
        
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo '</script>' . "\n";
    }
}
add_action( 'wp_head', 'dthree_breadcrumb_schema', 3 );

/**
 * Add robots meta tag
 */
function dthree_robots_meta() {
    $robots = array();
    
    if ( is_singular() ) {
        $robots[] = 'index';
        $robots[] = 'follow';
        $robots[] = 'max-image-preview:large';
        $robots[] = 'max-snippet:-1';
        $robots[] = 'max-video-preview:-1';
    } elseif ( is_archive() || is_search() ) {
        $robots[] = 'noindex';
        $robots[] = 'follow';
    }
    
    if ( ! empty( $robots ) ) {
        echo '<meta name="robots" content="' . esc_attr( implode( ', ', $robots ) ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'dthree_robots_meta', 1 );

/**
 * Optimize title tag for SEO
 */
function dthree_document_title_parts( $title ) {
    if ( is_singular() ) {
        // Keep only page title and site name
        $title['title'] = get_the_title();
        $title['site'] = get_bloginfo( 'name' );
        unset( $title['tagline'] );
    }
    
    return $title;
}
add_filter( 'document_title_parts', 'dthree_document_title_parts' );

/**
 * Add custom meta box for SEO fields
 */
function dthree_add_seo_meta_box() {
    add_meta_box(
        'dthree_seo_meta',
        __( 'SEO Settings', 'dthree-gutenberg' ),
        'dthree_seo_meta_box_callback',
        array( 'post', 'page' ),
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dthree_add_seo_meta_box' );

/**
 * SEO meta box callback
 */
function dthree_seo_meta_box_callback( $post ) {
    wp_nonce_field( 'dthree_seo_meta_box', 'dthree_seo_meta_box_nonce' );
    
    $meta_title = get_post_meta( $post->ID, '_dthree_meta_title', true );
    $meta_description = get_post_meta( $post->ID, '_dthree_meta_description', true );
    $focus_keyword = get_post_meta( $post->ID, '_dthree_focus_keyword', true );
    $noindex = get_post_meta( $post->ID, '_dthree_noindex', true );
    ?>
    
    <div class="dthree-seo-fields">
        <p>
            <label for="dthree_meta_title">
                <strong><?php esc_html_e( 'Meta Title', 'dthree-gutenberg' ); ?></strong>
                <span class="description"><?php esc_html_e( '(Optional - Leave empty to use post title)', 'dthree-gutenberg' ); ?></span>
            </label>
            <input type="text" 
                   id="dthree_meta_title" 
                   name="dthree_meta_title" 
                   value="<?php echo esc_attr( $meta_title ); ?>" 
                   class="widefat"
                   maxlength="60">
            <span class="char-count">0/60</span>
        </p>
        
        <p>
            <label for="dthree_meta_description">
                <strong><?php esc_html_e( 'Meta Description', 'dthree-gutenberg' ); ?></strong>
                <span class="description"><?php esc_html_e( '(Recommended: 150-160 characters)', 'dthree-gutenberg' ); ?></span>
            </label>
            <textarea 
                id="dthree_meta_description" 
                name="dthree_meta_description" 
                class="widefat" 
                rows="3"
                maxlength="160"><?php echo esc_textarea( $meta_description ); ?></textarea>
            <span class="char-count">0/160</span>
        </p>
        
        <p>
            <label for="dthree_focus_keyword">
                <strong><?php esc_html_e( 'Focus Keyword', 'dthree-gutenberg' ); ?></strong>
                <span class="description"><?php esc_html_e( '(Main keyword for this content)', 'dthree-gutenberg' ); ?></span>
            </label>
            <input type="text" 
                   id="dthree_focus_keyword" 
                   name="dthree_focus_keyword" 
                   value="<?php echo esc_attr( $focus_keyword ); ?>" 
                   class="widefat">
        </p>
        
        <p>
            <label>
                <input type="checkbox" 
                       name="dthree_noindex" 
                       value="1" 
                       <?php checked( $noindex, '1' ); ?>>
                <?php esc_html_e( 'Prevent search engines from indexing this page', 'dthree-gutenberg' ); ?>
            </label>
        </p>
    </div>
    
    <style>
        .dthree-seo-fields .char-count {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .dthree-seo-fields .description {
            display: block;
            font-style: italic;
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Character counter
        function updateCharCount(input, counter) {
            var length = $(input).val().length;
            var max = $(input).attr('maxlength');
            $(counter).text(length + '/' + max);
            
            if (length > max * 0.9) {
                $(counter).css('color', 'red');
            } else {
                $(counter).css('color', '#666');
            }
        }
        
        $('#dthree_meta_title').on('input', function() {
            updateCharCount(this, $(this).next('.char-count'));
        }).trigger('input');
        
        $('#dthree_meta_description').on('input', function() {
            updateCharCount(this, $(this).next('.char-count'));
        }).trigger('input');
    });
    </script>
    <?php
}

/**
 * Save SEO meta box data
 */
function dthree_save_seo_meta_box( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['dthree_seo_meta_box_nonce'] ) || 
         ! wp_verify_nonce( $_POST['dthree_seo_meta_box_nonce'], 'dthree_seo_meta_box' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save meta title
    if ( isset( $_POST['dthree_meta_title'] ) ) {
        update_post_meta( $post_id, '_dthree_meta_title', sanitize_text_field( $_POST['dthree_meta_title'] ) );
    }
    
    // Save meta description
    if ( isset( $_POST['dthree_meta_description'] ) ) {
        update_post_meta( $post_id, '_dthree_meta_description', sanitize_textarea_field( $_POST['dthree_meta_description'] ) );
    }
    
    // Save focus keyword
    if ( isset( $_POST['dthree_focus_keyword'] ) ) {
        update_post_meta( $post_id, '_dthree_focus_keyword', sanitize_text_field( $_POST['dthree_focus_keyword'] ) );
    }
    
    // Save noindex
    if ( isset( $_POST['dthree_noindex'] ) ) {
        update_post_meta( $post_id, '_dthree_noindex', '1' );
    } else {
        delete_post_meta( $post_id, '_dthree_noindex' );
    }
}
add_action( 'save_post', 'dthree_save_seo_meta_box' );

/**
 * Use custom meta title if set
 */
function dthree_custom_meta_title( $title ) {
    if ( is_singular() ) {
        $custom_title = get_post_meta( get_the_ID(), '_dthree_meta_title', true );
        if ( $custom_title ) {
            $title['title'] = $custom_title;
        }
    }
    return $title;
}
add_filter( 'document_title_parts', 'dthree_custom_meta_title', 20 );

/**
 * Use custom meta description if set
 */
add_filter( 'dthree_meta_description', function() {
    if ( is_singular() ) {
        $custom_description = get_post_meta( get_the_ID(), '_dthree_meta_description', true );
        if ( $custom_description ) {
            return $custom_description;
        }
    }
    return dthree_get_meta_description();
} );
