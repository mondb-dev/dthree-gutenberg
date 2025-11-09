<?php
/**
 * Logo Slider Block
 * Display client logos, partner logos, or brand showcases
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Logo Slider Block
 */
function dthree_register_logo_slider_block() {
    register_block_type( 'dthree/logo-slider', array(
        'api_version' => 2,
        'title'       => __( 'Logo Slider', 'dthree-gutenberg' ),
        'description' => __( 'Showcase client logos or partner brands in a slider', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'images-alt',
        'keywords'    => array( 'logo', 'client', 'partner', 'brand' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'sectionTitle' => array(
                'type'    => 'string',
                'default' => __( 'Our Clients', 'dthree-gutenberg' ),
            ),
            'logos'        => array(
                'type'    => 'array',
                'default' => array(),
            ),
            'autoplay'     => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'interval'     => array(
                'type'    => 'number',
                'default' => 3000,
            ),
            'itemsToShow'  => array(
                'type'    => 'number',
                'default' => 5,
            ),
            'grayscale'    => array(
                'type'    => 'boolean',
                'default' => true,
            ),
        ),
        'render_callback' => 'dthree_render_logo_slider_block',
    ) );
}
add_action( 'init', 'dthree_register_logo_slider_block' );

/**
 * Render Logo Slider Block
 */
function dthree_render_logo_slider_block( $attributes ) {
    $title = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $logos = isset( $attributes['logos'] ) ? $attributes['logos'] : array();
    $autoplay = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : true;
    $interval = isset( $attributes['interval'] ) ? $attributes['interval'] : 3000;
    $items = isset( $attributes['itemsToShow'] ) ? $attributes['itemsToShow'] : 5;
    $grayscale = isset( $attributes['grayscale'] ) ? $attributes['grayscale'] : true;
    
    if ( empty( $logos ) ) {
        return '<div class="alert alert-info">' . __( 'Add logos to the slider', 'dthree-gutenberg' ) . '</div>';
    }
    
    $slider_id = 'dthree-logo-slider-' . wp_rand( 1000, 9999 );
    $grayscale_class = $grayscale ? ' logo-grayscale' : '';
    
    // Calculate items per slide
    $chunks = array_chunk( $logos, $items );
    
    ob_start();
    ?>
    <div class="dthree-logo-slider-section py-5">
        <?php if ( ! empty( $title ) ) : ?>
            <div class="container">
                <h3 class="text-center mb-5"><?php echo esc_html( $title ); ?></h3>
            </div>
        <?php endif; ?>
        
        <div id="<?php echo esc_attr( $slider_id ); ?>" 
             class="carousel slide dthree-logo-slider<?php echo esc_attr( $grayscale_class ); ?>" 
             data-bs-ride="<?php echo $autoplay ? 'carousel' : 'false'; ?>"
             data-bs-interval="<?php echo esc_attr( $interval ); ?>">
            
            <div class="carousel-inner">
                <?php foreach ( $chunks as $index => $logo_group ) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="container">
                            <div class="row align-items-center justify-content-center g-4">
                                <?php foreach ( $logo_group as $logo ) : ?>
                                    <div class="col">
                                        <div class="logo-item text-center">
                                            <?php if ( ! empty( $logo['link'] ) ) : ?>
                                                <a href="<?php echo esc_url( $logo['link'] ); ?>" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer">
                                                    <img src="<?php echo esc_url( $logo['url'] ); ?>" 
                                                         alt="<?php echo esc_attr( $logo['alt'] ?? '' ); ?>"
                                                         class="img-fluid logo-image">
                                                </a>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url( $logo['url'] ); ?>" 
                                                     alt="<?php echo esc_attr( $logo['alt'] ?? '' ); ?>"
                                                     class="img-fluid logo-image">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if ( count( $chunks ) > 1 ) : ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e( 'Previous', 'dthree-gutenberg' ); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e( 'Next', 'dthree-gutenberg' ); ?></span>
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
