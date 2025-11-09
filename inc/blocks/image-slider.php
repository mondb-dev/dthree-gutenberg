<?php
/**
 * Image Slider/Carousel Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Image Slider Block
 */
function dthree_register_image_slider_block() {
    register_block_type( 'dthree/image-slider', array(
        'api_version' => 2,
        'title'       => __( 'Image Slider', 'dthree-gutenberg' ),
        'description' => __( 'Display images in a carousel/slider', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'images-alt2',
        'keywords'    => array( 'slider', 'carousel', 'gallery', 'images' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'images'          => array(
                'type'    => 'array',
                'default' => array(),
            ),
            'autoplay'        => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'interval'        => array(
                'type'    => 'number',
                'default' => 5000,
            ),
            'showControls'    => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'showIndicators'  => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'transitionEffect' => array(
                'type'    => 'string',
                'default' => 'slide', // slide or fade
            ),
            'height'          => array(
                'type'    => 'number',
                'default' => 500,
            ),
        ),
        'render_callback' => 'dthree_render_image_slider_block',
    ) );
}
add_action( 'init', 'dthree_register_image_slider_block' );

/**
 * Render Image Slider Block
 */
function dthree_render_image_slider_block( $attributes ) {
    $images = isset( $attributes['images'] ) ? $attributes['images'] : array();
    
    if ( empty( $images ) ) {
        return '<div class="alert alert-info">' . __( 'Add images to the slider', 'dthree-gutenberg' ) . '</div>';
    }
    
    $autoplay = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : true;
    $interval = isset( $attributes['interval'] ) ? $attributes['interval'] : 5000;
    $show_controls = isset( $attributes['showControls'] ) ? $attributes['showControls'] : true;
    $show_indicators = isset( $attributes['showIndicators'] ) ? $attributes['showIndicators'] : true;
    $effect = isset( $attributes['transitionEffect'] ) ? $attributes['transitionEffect'] : 'slide';
    $height = isset( $attributes['height'] ) ? $attributes['height'] : 500;
    
    $carousel_id = 'dthree-carousel-' . wp_rand( 1000, 9999 );
    $fade_class = $effect === 'fade' ? ' carousel-fade' : '';
    
    ob_start();
    ?>
    <div id="<?php echo esc_attr( $carousel_id ); ?>" 
         class="carousel slide<?php echo esc_attr( $fade_class ); ?> dthree-image-slider" 
         data-bs-ride="<?php echo $autoplay ? 'carousel' : 'false'; ?>"
         data-bs-interval="<?php echo esc_attr( $interval ); ?>">
        
        <?php if ( $show_indicators && count( $images ) > 1 ) : ?>
            <div class="carousel-indicators">
                <?php foreach ( $images as $index => $image ) : ?>
                    <button type="button" 
                            data-bs-target="#<?php echo esc_attr( $carousel_id ); ?>" 
                            data-bs-slide-to="<?php echo esc_attr( $index ); ?>" 
                            <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?>
                            aria-label="Slide <?php echo esc_attr( $index + 1 ); ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="carousel-inner">
            <?php foreach ( $images as $index => $image ) : ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo esc_url( $image['url'] ); ?>" 
                         class="d-block w-100" 
                         alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
                         style="height: <?php echo esc_attr( $height ); ?>px; object-fit: cover;">
                    
                    <?php if ( ! empty( $image['caption'] ) ) : ?>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo esc_html( $image['caption'] ); ?></h5>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ( $show_controls && count( $images ) > 1 ) : ?>
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
