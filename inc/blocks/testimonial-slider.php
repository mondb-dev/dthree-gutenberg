<?php
/**
 * Testimonial Slider Block
 * Enhanced testimonials with slider functionality
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Testimonial Slider Block
 */
function dthree_register_testimonial_slider_block() {
    register_block_type( 'dthree/testimonial-slider', array(
        'api_version' => 2,
        'title'       => __( 'Testimonial Slider', 'dthree-gutenberg' ),
        'description' => __( 'Rotating customer testimonials and reviews', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'format-quote',
        'keywords'    => array( 'testimonial', 'review', 'slider', 'quote' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'sectionTitle'    => array(
                'type'    => 'string',
                'default' => __( 'What Our Clients Say', 'dthree-gutenberg' ),
            ),
            'testimonials'    => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'name'     => __( 'John Doe', 'dthree-gutenberg' ),
                        'role'     => __( 'CEO, Company', 'dthree-gutenberg' ),
                        'content'  => __( 'This is an amazing product!', 'dthree-gutenberg' ),
                        'imageUrl' => '',
                        'rating'   => 5,
                    ),
                ),
            ),
            'autoplay'        => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'interval'        => array(
                'type'    => 'number',
                'default' => 6000,
            ),
            'showRating'      => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'style'           => array(
                'type'    => 'string',
                'default' => 'centered', // centered, cards, minimal
            ),
        ),
        'render_callback' => 'dthree_render_testimonial_slider_block',
    ) );
}
add_action( 'init', 'dthree_register_testimonial_slider_block' );

/**
 * Render Testimonial Slider Block
 */
function dthree_render_testimonial_slider_block( $attributes ) {
    $title = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $testimonials = isset( $attributes['testimonials'] ) ? $attributes['testimonials'] : array();
    $autoplay = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : true;
    $interval = isset( $attributes['interval'] ) ? $attributes['interval'] : 6000;
    $show_rating = isset( $attributes['showRating'] ) ? $attributes['showRating'] : true;
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'centered';
    
    if ( empty( $testimonials ) ) {
        return '<div class="alert alert-info">' . __( 'Add testimonials to the slider', 'dthree-gutenberg' ) . '</div>';
    }
    
    $carousel_id = 'dthree-testimonial-slider-' . wp_rand( 1000, 9999 );
    $style_class = 'testimonial-style-' . $style;
    
    ob_start();
    ?>
    <div class="dthree-testimonial-slider-section py-5 <?php echo esc_attr( $style_class ); ?>">
        <div class="container">
            <?php if ( ! empty( $title ) ) : ?>
                <h2 class="text-center mb-5"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            
            <div id="<?php echo esc_attr( $carousel_id ); ?>" 
                 class="carousel slide carousel-fade" 
                 data-bs-ride="<?php echo $autoplay ? 'carousel' : 'false'; ?>"
                 data-bs-interval="<?php echo esc_attr( $interval ); ?>">
                
                <div class="carousel-inner">
                    <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php if ( $style === 'centered' ) : ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="testimonial-content text-center">
                                            <?php if ( $show_rating && ! empty( $testimonial['rating'] ) ) : ?>
                                                <div class="testimonial-rating mb-3">
                                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                                        <i class="bi bi-star<?php echo $i <= $testimonial['rating'] ? '-fill' : ''; ?> text-warning"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <blockquote class="blockquote mb-4">
                                                <p class="fs-4">"<?php echo wp_kses_post( $testimonial['content'] ); ?>"</p>
                                            </blockquote>
                                            
                                            <div class="testimonial-author">
                                                <?php if ( ! empty( $testimonial['imageUrl'] ) ) : ?>
                                                    <img src="<?php echo esc_url( $testimonial['imageUrl'] ); ?>" 
                                                         alt="<?php echo esc_attr( $testimonial['name'] ); ?>"
                                                         class="rounded-circle mb-3"
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                <?php endif; ?>
                                                
                                                <h5 class="mb-0"><?php echo esc_html( $testimonial['name'] ); ?></h5>
                                                
                                                <?php if ( ! empty( $testimonial['role'] ) ) : ?>
                                                    <p class="text-muted"><?php echo esc_html( $testimonial['role'] ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php elseif ( $style === 'cards' ) : ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card shadow">
                                            <div class="card-body p-4">
                                                <?php if ( $show_rating && ! empty( $testimonial['rating'] ) ) : ?>
                                                    <div class="testimonial-rating mb-3">
                                                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                                            <i class="bi bi-star<?php echo $i <= $testimonial['rating'] ? '-fill' : ''; ?> text-warning"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <p class="mb-4">"<?php echo wp_kses_post( $testimonial['content'] ); ?>"</p>
                                                
                                                <div class="d-flex align-items-center">
                                                    <?php if ( ! empty( $testimonial['imageUrl'] ) ) : ?>
                                                        <img src="<?php echo esc_url( $testimonial['imageUrl'] ); ?>" 
                                                             alt="<?php echo esc_attr( $testimonial['name'] ); ?>"
                                                             class="rounded-circle me-3"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php endif; ?>
                                                    
                                                    <div>
                                                        <h6 class="mb-0"><?php echo esc_html( $testimonial['name'] ); ?></h6>
                                                        <?php if ( ! empty( $testimonial['role'] ) ) : ?>
                                                            <small class="text-muted"><?php echo esc_html( $testimonial['role'] ); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else : // minimal ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="testimonial-content">
                                            <blockquote class="blockquote text-center mb-4">
                                                <p class="fs-5"><?php echo wp_kses_post( $testimonial['content'] ); ?></p>
                                            </blockquote>
                                            
                                            <div class="text-center">
                                                <cite class="fw-bold"><?php echo esc_html( $testimonial['name'] ); ?></cite>
                                                <?php if ( ! empty( $testimonial['role'] ) ) : ?>
                                                    <span class="text-muted"> - <?php echo esc_html( $testimonial['role'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ( count( $testimonials ) > 1 ) : ?>
                    <div class="carousel-indicators position-static mt-4">
                        <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                            <button type="button" 
                                    data-bs-target="#<?php echo esc_attr( $carousel_id ); ?>" 
                                    data-bs-slide-to="<?php echo esc_attr( $index ); ?>" 
                                    <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?>
                                    aria-label="<?php echo esc_attr( $testimonial['name'] ); ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
