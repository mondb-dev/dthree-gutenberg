<?php
/**
 * Card Slider Block
 * Horizontal scrolling cards for products, services, or content
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Card Slider Block
 */
function dthree_register_card_slider_block() {
    register_block_type( 'dthree/card-slider', array(
        'api_version' => 2,
        'title'       => __( 'Card Slider', 'dthree-gutenberg' ),
        'description' => __( 'Horizontal scrolling cards showcase', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'screenoptions',
        'keywords'    => array( 'card', 'slider', 'scroll', 'horizontal' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'sectionTitle'    => array(
                'type'    => 'string',
                'default' => __( 'Featured Items', 'dthree-gutenberg' ),
            ),
            'sectionSubtitle' => array(
                'type'    => 'string',
                'default' => '',
            ),
            'cards'           => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'title'       => __( 'Card 1', 'dthree-gutenberg' ),
                        'description' => __( 'Card description', 'dthree-gutenberg' ),
                        'imageUrl'    => '',
                        'buttonText'  => __( 'Learn More', 'dthree-gutenberg' ),
                        'buttonUrl'   => '#',
                    ),
                ),
            ),
            'cardsPerView'    => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'autoplay'        => array(
                'type'    => 'boolean',
                'default' => false,
            ),
        ),
        'render_callback' => 'dthree_render_card_slider_block',
    ) );
}
add_action( 'init', 'dthree_register_card_slider_block' );

/**
 * Render Card Slider Block
 */
function dthree_render_card_slider_block( $attributes ) {
    $title = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : '';
    $subtitle = isset( $attributes['sectionSubtitle'] ) ? $attributes['sectionSubtitle'] : '';
    $cards = isset( $attributes['cards'] ) ? $attributes['cards'] : array();
    $per_view = isset( $attributes['cardsPerView'] ) ? $attributes['cardsPerView'] : 3;
    $autoplay = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
    
    if ( empty( $cards ) ) {
        return '<div class="alert alert-info">' . __( 'Add cards to the slider', 'dthree-gutenberg' ) . '</div>';
    }
    
    $slider_id = 'dthree-card-slider-' . wp_rand( 1000, 9999 );
    
    // Responsive column classes
    $col_class = 'col-12';
    if ( $per_view === 2 ) {
        $col_class = 'col-12 col-md-6';
    } elseif ( $per_view === 3 ) {
        $col_class = 'col-12 col-md-6 col-lg-4';
    } elseif ( $per_view >= 4 ) {
        $col_class = 'col-12 col-sm-6 col-md-4 col-lg-3';
    }
    
    ob_start();
    ?>
    <div class="dthree-card-slider-section py-5">
        <div class="container">
            <?php if ( ! empty( $title ) || ! empty( $subtitle ) ) : ?>
                <div class="text-center mb-5">
                    <?php if ( ! empty( $subtitle ) ) : ?>
                        <p class="text-muted text-uppercase mb-2"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $title ) ) : ?>
                        <h2 class="h3"><?php echo esc_html( $title ); ?></h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div id="<?php echo esc_attr( $slider_id ); ?>" 
                 class="carousel slide" 
                 data-bs-ride="<?php echo $autoplay ? 'carousel' : 'false'; ?>">
                
                <div class="carousel-inner">
                    <?php 
                    $chunks = array_chunk( $cards, $per_view );
                    foreach ( $chunks as $index => $card_group ) : 
                    ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row g-4">
                                <?php foreach ( $card_group as $card ) : ?>
                                    <div class="<?php echo esc_attr( $col_class ); ?>">
                                        <div class="card h-100 shadow-sm dthree-slider-card">
                                            <?php if ( ! empty( $card['imageUrl'] ) ) : ?>
                                                <img src="<?php echo esc_url( $card['imageUrl'] ); ?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo esc_attr( $card['title'] ?? '' ); ?>"
                                                     style="height: 200px; object-fit: cover;">
                                            <?php endif; ?>
                                            
                                            <div class="card-body">
                                                <?php if ( ! empty( $card['title'] ) ) : ?>
                                                    <h5 class="card-title"><?php echo esc_html( $card['title'] ); ?></h5>
                                                <?php endif; ?>
                                                
                                                <?php if ( ! empty( $card['description'] ) ) : ?>
                                                    <p class="card-text"><?php echo wp_kses_post( $card['description'] ); ?></p>
                                                <?php endif; ?>
                                                
                                                <?php if ( ! empty( $card['buttonText'] ) ) : ?>
                                                    <a href="<?php echo esc_url( $card['buttonUrl'] ?? '#' ); ?>" 
                                                       class="btn btn-primary btn-sm">
                                                        <?php echo esc_html( $card['buttonText'] ); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ( count( $chunks ) > 1 ) : ?>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary btn-sm me-2" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="prev">
                            <i class="bi bi-arrow-left"></i> <?php esc_html_e( 'Previous', 'dthree-gutenberg' ); ?>
                        </button>
                        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="next">
                            <?php esc_html_e( 'Next', 'dthree-gutenberg' ); ?> <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
