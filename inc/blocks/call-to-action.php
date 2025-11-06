<?php
/**
 * Call to Action Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Call to Action Block
 */
function dthree_register_cta_block() {
    register_block_type( 'dthree/call-to-action', array(
        'api_version' => 2,
        'title'       => __( 'Call to Action', 'dthree-gutenberg' ),
        'description' => __( 'A compelling call-to-action section with customizable buttons.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'megaphone',
        'keywords'    => array( 'cta', 'call', 'action', 'button' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'title'           => array(
                'type'    => 'string',
                'default' => __( 'Ready to Get Started?', 'dthree-gutenberg' ),
            ),
            'description'     => array(
                'type'    => 'string',
                'default' => __( 'Join thousands of satisfied customers today.', 'dthree-gutenberg' ),
            ),
            'primaryButtonText' => array(
                'type'    => 'string',
                'default' => __( 'Get Started', 'dthree-gutenberg' ),
            ),
            'primaryButtonUrl' => array(
                'type'    => 'string',
                'default' => '#',
            ),
            'secondaryButtonText' => array(
                'type'    => 'string',
                'default' => __( 'Learn More', 'dthree-gutenberg' ),
            ),
            'secondaryButtonUrl' => array(
                'type'    => 'string',
                'default' => '#',
            ),
            'backgroundColor' => array(
                'type'    => 'string',
                'default' => '#0d6efd',
            ),
            'textColor'       => array(
                'type'    => 'string',
                'default' => '#ffffff',
            ),
        ),
        'render_callback' => 'dthree_render_cta_block',
    ) );
}
add_action( 'init', 'dthree_register_cta_block' );

/**
 * Render Call to Action Block
 */
function dthree_render_cta_block( $attributes ) {
    $title                  = isset( $attributes['title'] ) ? $attributes['title'] : '';
    $description            = isset( $attributes['description'] ) ? $attributes['description'] : '';
    $primary_button_text    = isset( $attributes['primaryButtonText'] ) ? $attributes['primaryButtonText'] : '';
    $primary_button_url     = isset( $attributes['primaryButtonUrl'] ) ? $attributes['primaryButtonUrl'] : '#';
    $secondary_button_text  = isset( $attributes['secondaryButtonText'] ) ? $attributes['secondaryButtonText'] : '';
    $secondary_button_url   = isset( $attributes['secondaryButtonUrl'] ) ? $attributes['secondaryButtonUrl'] : '#';
    $background_color       = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#0d6efd';
    $text_color             = isset( $attributes['textColor'] ) ? $attributes['textColor'] : '#ffffff';

    $section_style = 'background-color: ' . esc_attr( $background_color ) . '; color: ' . esc_attr( $text_color ) . ';';

    ob_start();
    ?>
    <section class="dthree-cta-section py-5" style="<?php echo esc_attr( $section_style ); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <?php if ( ! empty( $title ) ) : ?>
                        <h2 class="display-4 fw-bold mb-4" data-aos="fade-up">
                            <?php echo wp_kses_post( $title ); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $description ) ) : ?>
                        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                            <?php echo wp_kses_post( $description ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="cta-buttons d-flex flex-wrap gap-3 justify-content-center" 
                         data-aos="fade-up" 
                         data-aos-delay="200">
                        <?php if ( ! empty( $primary_button_text ) ) : ?>
                            <a href="<?php echo esc_url( $primary_button_url ); ?>" 
                               class="btn btn-light btn-lg"
                               aria-label="<?php echo esc_attr( $primary_button_text ); ?>">
                                <?php echo esc_html( $primary_button_text ); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $secondary_button_text ) ) : ?>
                            <a href="<?php echo esc_url( $secondary_button_url ); ?>" 
                               class="btn btn-outline-light btn-lg"
                               aria-label="<?php echo esc_attr( $secondary_button_text ); ?>">
                                <?php echo esc_html( $secondary_button_text ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
