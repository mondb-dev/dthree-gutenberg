<?php
/**
 * Testimonials Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Testimonials Block
 */
function dthree_register_testimonials_block() {
    register_block_type( 'dthree/testimonials', array(
        'api_version' => 2,
        'title'       => __( 'Testimonials', 'dthree-gutenberg' ),
        'description' => __( 'Display customer testimonials with ratings and photos.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'star-filled',
        'keywords'    => array( 'testimonials', 'reviews', 'feedback' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'sectionTitle'   => array(
                'type'    => 'string',
                'default' => __( 'What Our Clients Say', 'dthree-gutenberg' ),
            ),
            'sectionSubtitle' => array(
                'type'    => 'string',
                'default' => __( 'Testimonials', 'dthree-gutenberg' ),
            ),
            'testimonials'   => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'name'    => __( 'Sarah Williams', 'dthree-gutenberg' ),
                        'role'    => __( 'CEO, TechCorp', 'dthree-gutenberg' ),
                        'image'   => '',
                        'content' => __( 'Outstanding service! They exceeded our expectations in every way.', 'dthree-gutenberg' ),
                        'rating'  => 5,
                    ),
                    array(
                        'name'    => __( 'David Brown', 'dthree-gutenberg' ),
                        'role'    => __( 'Marketing Director', 'dthree-gutenberg' ),
                        'image'   => '',
                        'content' => __( 'Professional, reliable, and creative. Highly recommended!', 'dthree-gutenberg' ),
                        'rating'  => 5,
                    ),
                    array(
                        'name'    => __( 'Emily Davis', 'dthree-gutenberg' ),
                        'role'    => __( 'Founder, StartupXYZ', 'dthree-gutenberg' ),
                        'image'   => '',
                        'content' => __( 'The best decision we made for our business. Amazing results!', 'dthree-gutenberg' ),
                        'rating'  => 5,
                    ),
                ),
            ),
            'columns'        => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'backgroundColor' => array(
                'type'    => 'string',
                'default' => '#f8f9fa',
            ),
        ),
        'render_callback' => 'dthree_render_testimonials_block',
    ) );
}
add_action( 'init', 'dthree_register_testimonials_block' );

/**
 * Render Testimonials Block
 */
function dthree_render_testimonials_block( $attributes ) {
    $section_title    = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $section_subtitle = isset( $attributes['sectionSubtitle'] ) ? $attributes['sectionSubtitle'] : '';
    $testimonials     = isset( $attributes['testimonials'] ) ? $attributes['testimonials'] : array();
    $columns          = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $background_color = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#f8f9fa';

    $col_class = 'col-md-' . ( 12 / $columns );
    $section_style = 'background-color: ' . esc_attr( $background_color ) . ';';

    ob_start();
    ?>
    <section class="dthree-testimonials-section py-5" style="<?php echo esc_attr( $section_style ); ?>">
        <div class="container">
            <?php if ( ! empty( $section_subtitle ) || ! empty( $section_title ) ) : ?>
                <div class="text-center mb-5">
                    <?php if ( ! empty( $section_subtitle ) ) : ?>
                        <p class="text-muted text-uppercase mb-2" data-aos="fade-up">
                            <?php echo wp_kses_post( $section_subtitle ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $section_title ) ) : ?>
                        <h2 class="display-5 fw-bold mb-0" data-aos="fade-up" data-aos-delay="100">
                            <?php echo wp_kses_post( $section_title ); ?>
                        </h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                    <div class="<?php echo esc_attr( $col_class ); ?>" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>">
                        <div class="testimonial-card bg-white p-4 rounded shadow-sm h-100">
                            <?php if ( isset( $testimonial['rating'] ) && $testimonial['rating'] > 0 ) : ?>
                                <div class="testimonial-rating mb-3" aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %d out of 5 stars', 'dthree-gutenberg' ), $testimonial['rating'] ) ); ?>">
                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                        <i class="bi bi-star<?php echo $i <= $testimonial['rating'] ? '-fill' : ''; ?> text-warning" 
                                           aria-hidden="true"></i>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $testimonial['content'] ) ) : ?>
                                <blockquote class="mb-4">
                                    <p class="mb-0">&ldquo;<?php echo wp_kses_post( $testimonial['content'] ); ?>&rdquo;</p>
                                </blockquote>
                            <?php endif; ?>
                            
                            <div class="testimonial-author d-flex align-items-center">
                                <?php if ( ! empty( $testimonial['image'] ) ) : ?>
                                    <img src="<?php echo esc_url( $testimonial['image'] ); ?>" 
                                         alt="<?php echo esc_attr( $testimonial['name'] ); ?>" 
                                         class="rounded-circle me-3"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else : ?>
                                    <div class="rounded-circle me-3 bg-light d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-person text-muted" aria-hidden="true"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <div>
                                    <?php if ( ! empty( $testimonial['name'] ) ) : ?>
                                        <div class="fw-bold"><?php echo wp_kses_post( $testimonial['name'] ); ?></div>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $testimonial['role'] ) ) : ?>
                                        <div class="text-muted small"><?php echo wp_kses_post( $testimonial['role'] ); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
