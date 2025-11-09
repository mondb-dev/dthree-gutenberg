<?php
/**
 * Tabs Component Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Tabs Block
 */
function dthree_register_tabs_block() {
    register_block_type( 'dthree/tabs', array(
        'api_version' => 2,
        'title'       => __( 'Tabs', 'dthree-gutenberg' ),
        'description' => __( 'Organize content in tabbed sections', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'table-col-after',
        'keywords'    => array( 'tabs', 'tabbed', 'navigation', 'sections' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'tabs'           => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'id'      => 'tab-1',
                        'title'   => __( 'Tab 1', 'dthree-gutenberg' ),
                        'content' => __( 'Content for tab 1', 'dthree-gutenberg' ),
                        'icon'    => '',
                    ),
                    array(
                        'id'      => 'tab-2',
                        'title'   => __( 'Tab 2', 'dthree-gutenberg' ),
                        'content' => __( 'Content for tab 2', 'dthree-gutenberg' ),
                        'icon'    => '',
                    ),
                ),
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'pills', // pills, underline, boxed
            ),
            'alignment'      => array(
                'type'    => 'string',
                'default' => 'left', // left, center, right
            ),
            'defaultTab'     => array(
                'type'    => 'number',
                'default' => 0,
            ),
        ),
        'render_callback' => 'dthree_render_tabs_block',
    ) );
}
add_action( 'init', 'dthree_register_tabs_block' );

/**
 * Render Tabs Block
 */
function dthree_render_tabs_block( $attributes ) {
    $tabs = isset( $attributes['tabs'] ) ? $attributes['tabs'] : array();
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'pills';
    $alignment = isset( $attributes['alignment'] ) ? $attributes['alignment'] : 'left';
    $default_tab = isset( $attributes['defaultTab'] ) ? $attributes['defaultTab'] : 0;
    
    if ( empty( $tabs ) ) {
        return '<div class="alert alert-info">' . __( 'Add tabs to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    $tabs_id = 'dthree-tabs-' . wp_rand( 1000, 9999 );
    $align_class = 'justify-content-' . $alignment;
    
    ob_start();
    ?>
    <div class="dthree-tabs dthree-tabs-<?php echo esc_attr( $style ); ?>">
        <ul class="nav nav-<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $align_class ); ?> mb-3" 
            id="<?php echo esc_attr( $tabs_id ); ?>" 
            role="tablist">
            <?php foreach ( $tabs as $index => $tab ) : 
                $is_active = $index === $default_tab;
                $tab_id = sanitize_title( $tab['id'] ?? 'tab-' . $index );
            ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo $is_active ? 'active' : ''; ?>" 
                            id="<?php echo esc_attr( $tab_id ); ?>-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#<?php echo esc_attr( $tab_id ); ?>-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="<?php echo esc_attr( $tab_id ); ?>-pane" 
                            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                        <?php if ( ! empty( $tab['icon'] ) ) : ?>
                            <i class="bi bi-<?php echo esc_attr( $tab['icon'] ); ?> me-2"></i>
                        <?php endif; ?>
                        <?php echo esc_html( $tab['title'] ); ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <div class="tab-content" id="<?php echo esc_attr( $tabs_id ); ?>-content">
            <?php foreach ( $tabs as $index => $tab ) : 
                $is_active = $index === $default_tab;
                $tab_id = sanitize_title( $tab['id'] ?? 'tab-' . $index );
            ?>
                <div class="tab-pane fade <?php echo $is_active ? 'show active' : ''; ?>" 
                     id="<?php echo esc_attr( $tab_id ); ?>-pane" 
                     role="tabpanel" 
                     aria-labelledby="<?php echo esc_attr( $tab_id ); ?>-tab" 
                     tabindex="0">
                    <div class="tab-content-inner">
                        <?php echo wp_kses_post( $tab['content'] ); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
