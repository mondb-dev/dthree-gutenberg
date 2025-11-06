<?php
/**
 * Hero Section Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Hero Section Block
 */
function dthree_register_hero_section_block() {
    // Register block
    register_block_type( 'dthree/hero-section', array(
        'api_version' => 2,
        'title'       => __( 'Hero Section', 'dthree-gutenberg' ),
        'description' => __( 'A customizable hero section with image, heading, text and call-to-action button.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'format-image',
        'keywords'    => array( 'hero', 'banner', 'header' ),
        'supports'    => array(
            'align'  => array( 'wide', 'full' ),
            'anchor' => true,
        ),
        'attributes'  => array(
            'title'            => array(
                'type'    => 'string',
                'default' => __( 'Welcome to Our Website', 'dthree-gutenberg' ),
            ),
            'subtitle'         => array(
                'type'    => 'string',
                'default' => __( 'We create amazing experiences', 'dthree-gutenberg' ),
            ),
            'description'      => array(
                'type'    => 'string',
                'default' => __( 'Discover our services and let us help you achieve your goals.', 'dthree-gutenberg' ),
            ),
            'buttonText'       => array(
                'type'    => 'string',
                'default' => __( 'Get Started', 'dthree-gutenberg' ),
            ),
            'buttonUrl'        => array(
                'type'    => 'string',
                'default' => '#',
            ),
            'backgroundImage'  => array(
                'type'    => 'string',
                'default' => '',
            ),
            'backgroundImageId' => array(
                'type'    => 'number',
                'default' => 0,
            ),
            'overlayOpacity'   => array(
                'type'    => 'number',
                'default' => 50,
            ),
            'textAlignment'    => array(
                'type'    => 'string',
                'default' => 'center',
            ),
            'minHeight'        => array(
                'type'    => 'number',
                'default' => 500,
            ),
            'textColor'        => array(
                'type'    => 'string',
                'default' => '#ffffff',
            ),
        ),
        'render_callback' => 'dthree_render_hero_section_block',
    ) );
}
add_action( 'init', 'dthree_register_hero_section_block' );

/**
 * Render Hero Section Block
 */
function dthree_render_hero_section_block( $attributes ) {
    $title            = isset( $attributes['title'] ) ? $attributes['title'] : '';
    $subtitle         = isset( $attributes['subtitle'] ) ? $attributes['subtitle'] : '';
    $description      = isset( $attributes['description'] ) ? $attributes['description'] : '';
    $button_text      = isset( $attributes['buttonText'] ) ? $attributes['buttonText'] : '';
    $button_url       = isset( $attributes['buttonUrl'] ) ? $attributes['buttonUrl'] : '#';
    $background_image = isset( $attributes['backgroundImage'] ) ? $attributes['backgroundImage'] : '';
    $overlay_opacity  = isset( $attributes['overlayOpacity'] ) ? $attributes['overlayOpacity'] : 50;
    $text_alignment   = isset( $attributes['textAlignment'] ) ? $attributes['textAlignment'] : 'center';
    $min_height       = isset( $attributes['minHeight'] ) ? $attributes['minHeight'] : 500;
    $text_color       = isset( $attributes['textColor'] ) ? $attributes['textColor'] : '#ffffff';

    $alignment_class = 'text-' . esc_attr( $text_alignment );
    $justify_class   = '';
    
    if ( $text_alignment === 'left' ) {
        $justify_class = 'justify-content-start';
    } elseif ( $text_alignment === 'right' ) {
        $justify_class = 'justify-content-end';
    } else {
        $justify_class = 'justify-content-center';
    }

    $style = 'min-height: ' . esc_attr( $min_height ) . 'px; color: ' . esc_attr( $text_color ) . ';';
    
    if ( ! empty( $background_image ) ) {
        $style .= ' background-image: url(' . esc_url( $background_image ) . '); background-size: cover; background-position: center;';
    }

    ob_start();
    ?>
    <section class="dthree-hero-section position-relative d-flex align-items-center <?php echo esc_attr( $alignment_class ); ?>" 
             style="<?php echo esc_attr( $style ); ?>"
             role="banner">
        <?php if ( ! empty( $background_image ) ) : ?>
            <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark" 
                 style="opacity: <?php echo esc_attr( $overlay_opacity / 100 ); ?>;"></div>
        <?php endif; ?>
        
        <div class="container position-relative">
            <div class="row <?php echo esc_attr( $justify_class ); ?>">
                <div class="col-lg-8">
                    <?php if ( ! empty( $subtitle ) ) : ?>
                        <p class="hero-subtitle fs-5 mb-3" data-aos="fade-up">
                            <?php echo wp_kses_post( $subtitle ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $title ) ) : ?>
                        <h1 class="hero-title display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                            <?php echo wp_kses_post( $title ); ?>
                        </h1>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $description ) ) : ?>
                        <p class="hero-description fs-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <?php echo wp_kses_post( $description ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $button_text ) ) : ?>
                        <a href="<?php echo esc_url( $button_url ); ?>" 
                           class="btn btn-primary btn-lg" 
                           data-aos="fade-up" 
                           data-aos-delay="300"
                           aria-label="<?php echo esc_attr( $button_text ); ?>">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Register block category
 */
function dthree_register_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'dthree-blocks',
                'title' => __( 'DThree Blocks', 'dthree-gutenberg' ),
                'icon'  => 'layout',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'dthree_register_block_category', 10, 1 );
