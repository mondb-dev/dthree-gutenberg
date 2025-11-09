<?php
/**
 * Accordion Component Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Accordion Block
 */
function dthree_register_accordion_block() {
    register_block_type( 'dthree/accordion', array(
        'api_version' => 2,
        'title'       => __( 'Accordion', 'dthree-gutenberg' ),
        'description' => __( 'Collapsible content sections for FAQs and more', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'menu',
        'keywords'    => array( 'accordion', 'collapse', 'faq', 'toggle' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'items'          => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'id'      => 'item-1',
                        'title'   => __( 'Accordion Item 1', 'dthree-gutenberg' ),
                        'content' => __( 'Content for accordion item 1', 'dthree-gutenberg' ),
                        'icon'    => '',
                        'open'    => true,
                    ),
                    array(
                        'id'      => 'item-2',
                        'title'   => __( 'Accordion Item 2', 'dthree-gutenberg' ),
                        'content' => __( 'Content for accordion item 2', 'dthree-gutenberg' ),
                        'icon'    => '',
                        'open'    => false,
                    ),
                ),
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'default', // default, bordered, flush
            ),
            'allowMultiple'  => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'iconPosition'   => array(
                'type'    => 'string',
                'default' => 'right', // left, right
            ),
        ),
        'render_callback' => 'dthree_render_accordion_block',
    ) );
}
add_action( 'init', 'dthree_register_accordion_block' );

/**
 * Render Accordion Block
 */
function dthree_render_accordion_block( $attributes ) {
    $items = isset( $attributes['items'] ) ? $attributes['items'] : array();
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'default';
    $allow_multiple = isset( $attributes['allowMultiple'] ) ? $attributes['allowMultiple'] : false;
    $icon_position = isset( $attributes['iconPosition'] ) ? $attributes['iconPosition'] : 'right';
    
    if ( empty( $items ) ) {
        return '<div class="alert alert-info">' . __( 'Add accordion items to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    $accordion_id = 'dthree-accordion-' . wp_rand( 1000, 9999 );
    $accordion_class = 'accordion';
    
    if ( $style === 'flush' ) {
        $accordion_class .= ' accordion-flush';
    }
    
    $accordion_class .= ' dthree-accordion dthree-accordion-' . $style;
    $accordion_class .= ' icon-' . $icon_position;
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr( $accordion_class ); ?>" id="<?php echo esc_attr( $accordion_id ); ?>">
        <?php foreach ( $items as $index => $item ) : 
            $item_id = sanitize_title( $item['id'] ?? 'item-' . $index );
            $is_open = isset( $item['open'] ) && $item['open'];
            $parent_attr = $allow_multiple ? '' : 'data-bs-parent="#' . esc_attr( $accordion_id ) . '"';
        ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-<?php echo esc_attr( $item_id ); ?>">
                    <button class="accordion-button <?php echo $is_open ? '' : 'collapsed'; ?>" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse-<?php echo esc_attr( $item_id ); ?>" 
                            aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" 
                            aria-controls="collapse-<?php echo esc_attr( $item_id ); ?>">
                        <?php if ( ! empty( $item['icon'] ) && $icon_position === 'left' ) : ?>
                            <i class="bi bi-<?php echo esc_attr( $item['icon'] ); ?> me-2"></i>
                        <?php endif; ?>
                        
                        <span class="accordion-title"><?php echo esc_html( $item['title'] ); ?></span>
                        
                        <?php if ( ! empty( $item['icon'] ) && $icon_position === 'right' ) : ?>
                            <i class="bi bi-<?php echo esc_attr( $item['icon'] ); ?> ms-2"></i>
                        <?php endif; ?>
                    </button>
                </h2>
                <div id="collapse-<?php echo esc_attr( $item_id ); ?>" 
                     class="accordion-collapse collapse <?php echo $is_open ? 'show' : ''; ?>" 
                     aria-labelledby="heading-<?php echo esc_attr( $item_id ); ?>" 
                     <?php echo $parent_attr; ?>>
                    <div class="accordion-body">
                        <?php echo wp_kses_post( $item['content'] ); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
