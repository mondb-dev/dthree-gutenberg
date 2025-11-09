<?php
/**
 * Content Slider Block
 * Full-featured content slides with text, images, buttons
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Content Slider Block
 */
function dthree_register_content_slider_block() {
    register_block_type( 'dthree/content-slider', array(
        'api_version' => 2,
        'title'       => __( 'Content Slider', 'dthree-gutenberg' ),
        'description' => __( 'Advanced slider with text, images, and call-to-action buttons', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'slides',
        'keywords'    => array( 'slider', 'carousel', 'hero', 'banner' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'slides'          => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'title'       => __( 'Slide 1', 'dthree-gutenberg' ),
                        'description' => __( 'Add your content here', 'dthree-gutenberg' ),
                        'buttonText'  => __( 'Learn More', 'dthree-gutenberg' ),
                        'buttonUrl'   => '#',
                        'imageUrl'    => '',
                        'imageId'     => 0,
                    ),
                ),
            ),
            'autoplay'        => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'interval'        => array(
                'type'    => 'number',
                'default' => 7000,
            ),
            'height'          => array(
                'type'    => 'number',
                'default' => 600,
            ),
            'overlayOpacity'  => array(
                'type'    => 'number',
                'default' => 50,
            ),
            'textAlignment'   => array(
                'type'    => 'string',
                'default' => 'center',
            ),
        ),
        'render_callback' => 'dthree_render_content_slider_block',
    ) );
}
add_action( 'init', 'dthree_register_content_slider_block' );

/**
 * Render Content Slider Block
 */
function dthree_render_content_slider_block( $attributes ) {
    $slides = isset( $attributes['slides'] ) ? $attributes['slides'] : array();
    
    if ( empty( $slides ) ) {
        return '<div class="alert alert-info">' . __( 'Add slides to the slider', 'dthree-gutenberg' ) . '</div>';
    }
    
    $autoplay = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : true;
    $interval = isset( $attributes['interval'] ) ? $attributes['interval'] : 7000;
    $height = isset( $attributes['height'] ) ? $attributes['height'] : 600;
    $overlay = isset( $attributes['overlayOpacity'] ) ? $attributes['overlayOpacity'] : 50;
    $alignment = isset( $attributes['textAlignment'] ) ? $attributes['textAlignment'] : 'center';
    
    $carousel_id = 'dthree-content-slider-' . wp_rand( 1000, 9999 );
    $align_class = 'text-' . $alignment;
    
    ob_start();
    ?>
    <div id="<?php echo esc_attr( $carousel_id ); ?>" 
         class="carousel slide carousel-fade dthree-content-slider" 
         data-bs-ride="<?php echo $autoplay ? 'carousel' : 'false'; ?>"
         data-bs-interval="<?php echo esc_attr( $interval ); ?>">
        
        <div class="carousel-indicators">
            <?php foreach ( $slides as $index => $slide ) : ?>
                <button type="button" 
                        data-bs-target="#<?php echo esc_attr( $carousel_id ); ?>" 
                        data-bs-slide-to="<?php echo esc_attr( $index ); ?>" 
                        <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?>
                        aria-label="Slide <?php echo esc_attr( $index + 1 ); ?>">
                </button>
            <?php endforeach; ?>
        </div>
        
        <div class="carousel-inner">
            <?php foreach ( $slides as $index => $slide ) : ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" 
                     style="min-height: <?php echo esc_attr( $height ); ?>px;">
                    
                    <?php if ( ! empty( $slide['imageUrl'] ) ) : ?>
                        <img src="<?php echo esc_url( $slide['imageUrl'] ); ?>" 
                             class="d-block w-100" 
                             alt="<?php echo esc_attr( $slide['title'] ?? '' ); ?>"
                             style="height: <?php echo esc_attr( $height ); ?>px; object-fit: cover;">
                        
                        <div class="carousel-item-overlay" 
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                                    background: rgba(0,0,0,<?php echo esc_attr( $overlay / 100 ); ?>);"></div>
                    <?php endif; ?>
                    
                    <div class="carousel-caption d-flex align-items-center justify-content-center h-100 <?php echo esc_attr( $align_class ); ?>">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <?php if ( ! empty( $slide['title'] ) ) : ?>
                                        <h2 class="display-4 fw-bold mb-4" data-aos="fade-up">
                                            <?php echo wp_kses_post( $slide['title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $slide['description'] ) ) : ?>
                                        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                                            <?php echo wp_kses_post( $slide['description'] ); ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $slide['buttonText'] ) ) : ?>
                                        <a href="<?php echo esc_url( $slide['buttonUrl'] ?? '#' ); ?>" 
                                           class="btn btn-primary btn-lg" 
                                           data-aos="fade-up" 
                                           data-aos-delay="200">
                                            <?php echo esc_html( $slide['buttonText'] ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ( count( $slides ) > 1 ) : ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr( $carousel_id ); ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e( 'Previous', 'dthree-gutenberg' ); ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr( $carousel_id ); ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e( 'Next', 'dthree-gutenberg' ); ?></span>
            </button>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
