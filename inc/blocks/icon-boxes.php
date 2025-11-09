<?php
/**
 * Icon Boxes Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Icon Boxes Block
 */
function dthree_register_icon_boxes_block() {
    register_block_type( 'dthree/icon-boxes', array(
        'api_version' => 2,
        'title'       => __( 'Icon Boxes', 'dthree-gutenberg' ),
        'description' => __( 'Showcase features or services with icon boxes', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'grid-view',
        'keywords'    => array( 'icon', 'boxes', 'features', 'services', 'cards' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'boxes'          => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'icon'        => 'lightning-fill',
                        'title'       => __( 'Fast Performance', 'dthree-gutenberg' ),
                        'description' => __( 'Lightning fast loading speeds', 'dthree-gutenberg' ),
                        'link'        => '',
                    ),
                    array(
                        'icon'        => 'shield-fill-check',
                        'title'       => __( 'Secure', 'dthree-gutenberg' ),
                        'description' => __( 'Enterprise-level security', 'dthree-gutenberg' ),
                        'link'        => '',
                    ),
                    array(
                        'icon'        => 'phone-fill',
                        'title'       => __( 'Responsive', 'dthree-gutenberg' ),
                        'description' => __( 'Works on all devices', 'dthree-gutenberg' ),
                        'link'        => '',
                    ),
                ),
            ),
            'columns'        => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'card', // card, minimal, bordered, hover
            ),
            'iconStyle'      => array(
                'type'    => 'string',
                'default' => 'circle', // circle, square, none
            ),
            'iconPosition'   => array(
                'type'    => 'string',
                'default' => 'top', // top, left
            ),
            'textAlign'      => array(
                'type'    => 'string',
                'default' => 'center', // left, center
            ),
        ),
        'render_callback' => 'dthree_render_icon_boxes_block',
    ) );
}
add_action( 'init', 'dthree_register_icon_boxes_block' );

/**
 * Render Icon Boxes Block
 */
function dthree_render_icon_boxes_block( $attributes ) {
    $boxes = isset( $attributes['boxes'] ) ? $attributes['boxes'] : array();
    $columns = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'card';
    $icon_style = isset( $attributes['iconStyle'] ) ? $attributes['iconStyle'] : 'circle';
    $icon_position = isset( $attributes['iconPosition'] ) ? $attributes['iconPosition'] : 'top';
    $text_align = isset( $attributes['textAlign'] ) ? $attributes['textAlign'] : 'center';
    
    if ( empty( $boxes ) ) {
        return '<div class="alert alert-info">' . __( 'Add icon boxes to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    $col_class = 'col-md-6 col-lg-' . ( 12 / min( $columns, 4 ) );
    
    ob_start();
    ?>
    <div class="dthree-icon-boxes icon-boxes-<?php echo esc_attr( $style ); ?> icon-<?php echo esc_attr( $icon_style ); ?> icon-position-<?php echo esc_attr( $icon_position ); ?>">
        <div class="row g-4">
            <?php foreach ( $boxes as $box ) : 
                $has_link = ! empty( $box['link'] );
                $tag = $has_link ? 'a' : 'div';
                $link_attrs = $has_link ? 'href="' . esc_url( $box['link'] ) . '"' : '';
            ?>
                <div class="<?php echo esc_attr( $col_class ); ?>">
                    <<?php echo esc_attr( $tag ); ?> class="icon-box text-<?php echo esc_attr( $text_align ); ?>" <?php echo $link_attrs; ?>>
                        <?php if ( ! empty( $box['icon'] ) ) : ?>
                            <div class="icon-box-icon">
                                <i class="bi bi-<?php echo esc_attr( $box['icon'] ); ?>"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="icon-box-content">
                            <?php if ( ! empty( $box['title'] ) ) : ?>
                                <h4 class="icon-box-title"><?php echo esc_html( $box['title'] ); ?></h4>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $box['description'] ) ) : ?>
                                <p class="icon-box-description"><?php echo esc_html( $box['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </<?php echo esc_attr( $tag ); ?>>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
