<?php
/**
 * Features Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Features Block
 */
function dthree_register_features_block() {
    register_block_type( 'dthree/features', array(
        'api_version' => 2,
        'title'       => __( 'Features Section', 'dthree-gutenberg' ),
        'description' => __( 'Display features or services in a grid layout with icons.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'grid-view',
        'keywords'    => array( 'features', 'services', 'grid' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'sectionTitle'   => array(
                'type'    => 'string',
                'default' => __( 'Our Features', 'dthree-gutenberg' ),
            ),
            'sectionSubtitle' => array(
                'type'    => 'string',
                'default' => __( 'What we offer', 'dthree-gutenberg' ),
            ),
            'features'       => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'icon'        => 'bi-lightning-charge',
                        'title'       => __( 'Fast Performance', 'dthree-gutenberg' ),
                        'description' => __( 'Lightning-fast load times for better user experience.', 'dthree-gutenberg' ),
                    ),
                    array(
                        'icon'        => 'bi-shield-check',
                        'title'       => __( 'Secure & Safe', 'dthree-gutenberg' ),
                        'description' => __( 'Enterprise-grade security to protect your data.', 'dthree-gutenberg' ),
                    ),
                    array(
                        'icon'        => 'bi-phone',
                        'title'       => __( 'Mobile Friendly', 'dthree-gutenberg' ),
                        'description' => __( 'Fully responsive design that works on all devices.', 'dthree-gutenberg' ),
                    ),
                ),
            ),
            'columns'        => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'backgroundColor' => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
        'render_callback' => 'dthree_render_features_block',
    ) );
}
add_action( 'init', 'dthree_register_features_block' );

/**
 * Render Features Block
 */
function dthree_render_features_block( $attributes ) {
    $section_title    = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $section_subtitle = isset( $attributes['sectionSubtitle'] ) ? $attributes['sectionSubtitle'] : '';
    $features         = isset( $attributes['features'] ) ? $attributes['features'] : array();
    $columns          = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $background_color = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '';

    $col_class = 'col-md-' . ( 12 / $columns );
    $section_style = ! empty( $background_color ) ? 'background-color: ' . esc_attr( $background_color ) . ';' : '';

    ob_start();
    ?>
    <section class="dthree-features-section py-5" style="<?php echo esc_attr( $section_style ); ?>">
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
                <?php foreach ( $features as $index => $feature ) : ?>
                    <div class="<?php echo esc_attr( $col_class ); ?>" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>">
                        <div class="feature-item text-center p-4 h-100">
                            <?php if ( ! empty( $feature['icon'] ) ) : ?>
                                <div class="feature-icon mb-3">
                                    <i class="<?php echo esc_attr( $feature['icon'] ); ?> fs-1 text-primary" 
                                       aria-hidden="true"></i>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $feature['title'] ) ) : ?>
                                <h3 class="h5 mb-3"><?php echo wp_kses_post( $feature['title'] ); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $feature['description'] ) ) : ?>
                                <p class="text-muted mb-0"><?php echo wp_kses_post( $feature['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
