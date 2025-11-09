<?php
/**
 * Theme Enhancements
 * Additional features and helper functions
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display Reading Time
 */
function dthree_display_reading_time( $display = true ) {
    if ( ! is_singular( 'post' ) ) {
        return '';
    }
    
    $reading_time = dthree_get_reading_time();
    
    $output = '<span class="reading-time">';
    $output .= '<i class="bi bi-clock me-1"></i>';
    $output .= esc_html( $reading_time );
    $output .= '</span>';
    
    if ( $display ) {
        echo $output;
    }
    
    return $output;
}

/**
 * Related Posts
 */
function dthree_related_posts( $args = array() ) {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    
    $defaults = array(
        'posts_per_page' => 3,
        'show_thumbnail' => true,
        'show_excerpt'   => true,
        'show_date'      => true,
        'title'          => __( 'Related Posts', 'dthree-gutenberg' ),
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    global $post;
    
    // Get current post categories
    $categories = wp_get_post_categories( $post->ID );
    
    if ( empty( $categories ) ) {
        return;
    }
    
    // Query related posts
    $related_query = new WP_Query( array(
        'category__in'        => $categories,
        'post__not_in'        => array( $post->ID ),
        'posts_per_page'      => $args['posts_per_page'],
        'ignore_sticky_posts' => 1,
        'orderby'             => 'rand',
    ) );
    
    if ( ! $related_query->have_posts() ) {
        return;
    }
    
    ?>
    <div class="related-posts mt-5 mb-5">
        <h3 class="related-posts-title h4 mb-4"><?php echo esc_html( $args['title'] ); ?></h3>
        <div class="row">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <div class="col-md-4 mb-4">
                    <article class="related-post card h-100">
                        <?php if ( $args['show_thumbnail'] && has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="related-post-thumbnail">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h4 class="related-post-title h6">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            
                            <?php if ( $args['show_date'] ) : ?>
                                <div class="related-post-meta text-muted small mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $args['show_excerpt'] ) : ?>
                                <div class="related-post-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 15 ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">
                                <?php esc_html_e( 'Read More', 'dthree-gutenberg' ); ?>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    
    wp_reset_postdata();
}

/**
 * Table of Contents Generator
 */
function dthree_generate_table_of_contents( $content ) {
    if ( ! is_singular( 'post' ) || ! in_the_loop() ) {
        return $content;
    }
    
    // Only add TOC if enabled in customizer
    if ( ! get_theme_mod( 'dthree_enable_toc', false ) ) {
        return $content;
    }
    
    // Extract headings
    preg_match_all( '/<h([2-3])([^>]*)>(.*?)<\/h\1>/i', $content, $matches, PREG_SET_ORDER );
    
    if ( count( $matches ) < 3 ) {
        return $content; // Don't show TOC for less than 3 headings
    }
    
    $toc = '<div class="table-of-contents card mb-4">';
    $toc .= '<div class="card-body">';
    $toc .= '<h3 class="toc-title h6 mb-3">' . esc_html__( 'Table of Contents', 'dthree-gutenberg' ) . '</h3>';
    $toc .= '<ol class="toc-list mb-0">';
    
    $heading_count = 0;
    
    foreach ( $matches as $heading ) {
        $level = $heading[1];
        $text = strip_tags( $heading[3] );
        $id = 'toc-' . sanitize_title( $text ) . '-' . $heading_count;
        
        // Add ID to heading in content
        $content = str_replace( $heading[0], '<h' . $level . ' id="' . $id . '">' . $heading[3] . '</h' . $level . '>', $content );
        
        $class = $level == 3 ? 'toc-subitem' : '';
        $toc .= '<li class="' . $class . '"><a href="#' . $id . '">' . esc_html( $text ) . '</a></li>';
        
        $heading_count++;
    }
    
    $toc .= '</ol>';
    $toc .= '</div>';
    $toc .= '</div>';
    
    // Insert TOC after first paragraph
    $content = preg_replace( '/(<p>.*?<\/p>)/i', '$1' . $toc, $content, 1 );
    
    return $content;
}
add_filter( 'the_content', 'dthree_generate_table_of_contents', 10 );

/**
 * Post View Counter
 */
function dthree_set_post_views( $post_id = 0 ) {
    if ( empty( $post_id ) ) {
        $post_id = get_the_ID();
    }
    
    $count_key = 'dthree_post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( empty( $count ) ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '1' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

/**
 * Track post views on single posts
 */
function dthree_track_post_views( $post_id ) {
    if ( ! is_single() ) {
        return;
    }
    
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }
    
    // Don't count views from bots or logged-in admins (optional)
    if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
        dthree_set_post_views( $post_id );
    }
}
add_action( 'wp_head', 'dthree_track_post_views' );

/**
 * Get post views count
 */
function dthree_get_post_views( $post_id = 0 ) {
    if ( empty( $post_id ) ) {
        $post_id = get_the_ID();
    }
    
    $count_key = 'dthree_post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( empty( $count ) ) {
        return 0;
    }
    
    return absint( $count );
}

/**
 * Display post views
 */
function dthree_display_post_views( $post_id = 0, $display = true ) {
    $views = dthree_get_post_views( $post_id );
    
    $output = '<span class="post-views">';
    $output .= '<i class="bi bi-eye me-1"></i>';
    $output .= sprintf(
        _n( '%s view', '%s views', $views, 'dthree-gutenberg' ),
        number_format_i18n( $views )
    );
    $output .= '</span>';
    
    if ( $display ) {
        echo $output;
    }
    
    return $output;
}

/**
 * Cookie Consent Notice
 */
function dthree_cookie_consent_notice() {
    // Check if consent is disabled in customizer
    if ( ! get_theme_mod( 'dthree_enable_cookie_consent', true ) ) {
        return;
    }
    
    ?>
    <div id="dthree-cookie-consent" class="cookie-consent" style="display: none;">
        <div class="cookie-consent-content">
            <p class="cookie-consent-text mb-2">
                <?php 
                echo wp_kses_post( 
                    get_theme_mod( 
                        'dthree_cookie_consent_text', 
                        __( 'We use cookies to ensure you get the best experience on our website. By continuing to browse, you agree to our use of cookies.', 'dthree-gutenberg' )
                    ) 
                ); 
                ?>
                <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" class="cookie-consent-link">
                    <?php esc_html_e( 'Learn more', 'dthree-gutenberg' ); ?>
                </a>
            </p>
            <div class="cookie-consent-actions">
                <button id="dthree-accept-cookies" class="btn btn-primary btn-sm">
                    <?php esc_html_e( 'Accept', 'dthree-gutenberg' ); ?>
                </button>
                <button id="dthree-decline-cookies" class="btn btn-outline-secondary btn-sm ms-2">
                    <?php esc_html_e( 'Decline', 'dthree-gutenberg' ); ?>
                </button>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'dthree_cookie_consent_notice' );

/**
 * Popular Posts Widget
 */
class DThree_Popular_Posts_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'dthree_popular_posts',
            __( 'DThree - Popular Posts', 'dthree-gutenberg' ),
            array( 'description' => __( 'Display most viewed posts', 'dthree-gutenberg' ) )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Popular Posts', 'dthree-gutenberg' );
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
        $show_views = isset( $instance['show_views'] ) ? (bool) $instance['show_views'] : true;
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }
        
        $popular_posts = new WP_Query( array(
            'posts_per_page'      => $number,
            'meta_key'            => 'dthree_post_views_count',
            'orderby'             => 'meta_value_num',
            'order'               => 'DESC',
            'ignore_sticky_posts' => 1,
        ) );
        
        if ( $popular_posts->have_posts() ) {
            echo '<ul class="popular-posts-list list-unstyled">';
            
            while ( $popular_posts->have_posts() ) {
                $popular_posts->the_post();
                ?>
                <li class="popular-post-item mb-3 pb-3 border-bottom">
                    <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                        <div class="row g-2">
                            <div class="col-4">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid rounded' ) ); ?>
                                </a>
                            </div>
                            <div class="col-8">
                    <?php else : ?>
                        <div>
                    <?php endif; ?>
                    
                                <h6 class="h6 mb-1">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <?php the_title(); ?>
                                    </a>
                                </h6>
                                
                                <div class="post-meta small text-muted">
                                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    
                                    <?php if ( $show_views ) : ?>
                                        <span class="ms-2">
                                            <?php dthree_display_post_views(); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                    <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                            </div>
                        </div>
                    <?php else : ?>
                        </div>
                    <?php endif; ?>
                </li>
                <?php
            }
            
            echo '</ul>';
            wp_reset_postdata();
        }
        
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Popular Posts', 'dthree-gutenberg' );
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
        $show_views = isset( $instance['show_views'] ) ? (bool) $instance['show_views'] : true;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'dthree-gutenberg' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" 
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
                <?php esc_html_e( 'Number of posts:', 'dthree-gutenberg' ); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" 
                   step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3">
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> 
                   id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>">
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>">
                <?php esc_html_e( 'Show thumbnails', 'dthree-gutenberg' ); ?>
            </label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_views ); ?> 
                   id="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'show_views' ) ); ?>">
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>">
                <?php esc_html_e( 'Show view count', 'dthree-gutenberg' ); ?>
            </label>
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number'] = ! empty( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 5;
        $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
        $instance['show_views'] = isset( $new_instance['show_views'] ) ? (bool) $new_instance['show_views'] : false;
        
        return $instance;
    }
}

/**
 * Register Popular Posts Widget
 */
function dthree_register_popular_posts_widget() {
    register_widget( 'DThree_Popular_Posts_Widget' );
}
add_action( 'widgets_init', 'dthree_register_popular_posts_widget' );

/**
 * Newsletter Subscription Widget
 */
class DThree_Newsletter_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'dthree_newsletter',
            __( 'DThree - Newsletter Signup', 'dthree-gutenberg' ),
            array( 'description' => __( 'Email subscription form', 'dthree-gutenberg' ) )
        );
    }
    
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Subscribe to Newsletter', 'dthree-gutenberg' );
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $form_action = ! empty( $instance['form_action'] ) ? $instance['form_action'] : '';
        $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : __( 'Subscribe', 'dthree-gutenberg' );
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }
        
        if ( ! empty( $description ) ) {
            echo '<p class="newsletter-description">' . wp_kses_post( $description ) . '</p>';
        }
        ?>
        
        <form class="newsletter-form" action="<?php echo esc_url( $form_action ); ?>" method="post" target="_blank">
            <div class="mb-3">
                <label for="newsletter-email-<?php echo esc_attr( $this->id ); ?>" class="visually-hidden">
                    <?php esc_html_e( 'Email Address', 'dthree-gutenberg' ); ?>
                </label>
                <input type="email" 
                       class="form-control" 
                       id="newsletter-email-<?php echo esc_attr( $this->id ); ?>" 
                       name="EMAIL" 
                       placeholder="<?php esc_attr_e( 'Enter your email', 'dthree-gutenberg' ); ?>" 
                       required>
            </div>
            
            <!-- Honeypot field -->
            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_newsletter_hp" tabindex="-1" value="">
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                <?php echo esc_html( $button_text ); ?>
            </button>
        </form>
        
        <?php
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Subscribe to Newsletter', 'dthree-gutenberg' );
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $form_action = ! empty( $instance['form_action'] ) ? $instance['form_action'] : '';
        $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : __( 'Subscribe', 'dthree-gutenberg' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'dthree-gutenberg' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" 
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
                <?php esc_html_e( 'Description:', 'dthree-gutenberg' ); ?>
            </label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" 
                      name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" 
                      rows="3"><?php echo esc_textarea( $description ); ?></textarea>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>">
                <?php esc_html_e( 'Form Action URL:', 'dthree-gutenberg' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'form_action' ) ); ?>" type="url" 
                   value="<?php echo esc_url( $form_action ); ?>">
            <small><?php esc_html_e( 'Enter your Mailchimp, ConvertKit, or other service form action URL', 'dthree-gutenberg' ); ?></small>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>">
                <?php esc_html_e( 'Button Text:', 'dthree-gutenberg' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" 
                   value="<?php echo esc_attr( $button_text ); ?>">
        </p>
        <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['description'] = ! empty( $new_instance['description'] ) ? wp_kses_post( $new_instance['description'] ) : '';
        $instance['form_action'] = ! empty( $new_instance['form_action'] ) ? esc_url_raw( $new_instance['form_action'] ) : '';
        $instance['button_text'] = ! empty( $new_instance['button_text'] ) ? sanitize_text_field( $new_instance['button_text'] ) : '';
        
        return $instance;
    }
}

/**
 * Register Newsletter Widget
 */
function dthree_register_newsletter_widget() {
    register_widget( 'DThree_Newsletter_Widget' );
}
add_action( 'widgets_init', 'dthree_register_newsletter_widget' );
