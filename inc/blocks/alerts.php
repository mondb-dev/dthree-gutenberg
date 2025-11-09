<?php
/**
 * Alerts Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Alerts Block
 */
function dthree_register_alerts_block() {
    register_block_type( 'dthree/alerts', array(
        'api_version' => 2,
        'title'       => __( 'Alert', 'dthree-gutenberg' ),
        'description' => __( 'Display contextual feedback messages', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'info',
        'keywords'    => array( 'alert', 'notice', 'message', 'notification', 'warning' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'type'           => array(
                'type'    => 'string',
                'default' => 'info', // primary, secondary, success, danger, warning, info, light, dark
            ),
            'title'          => array(
                'type'    => 'string',
                'default' => '',
            ),
            'content'        => array(
                'type'    => 'string',
                'default' => __( 'This is an alert message', 'dthree-gutenberg' ),
            ),
            'icon'           => array(
                'type'    => 'string',
                'default' => '', // Bootstrap icon name
            ),
            'dismissible'    => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'showIcon'       => array(
                'type'    => 'boolean',
                'default' => true,
            ),
        ),
        'render_callback' => 'dthree_render_alerts_block',
    ) );
}
add_action( 'init', 'dthree_register_alerts_block' );

/**
 * Render Alerts Block
 */
function dthree_render_alerts_block( $attributes ) {
    $type = isset( $attributes['type'] ) ? $attributes['type'] : 'info';
    $title = isset( $attributes['title'] ) ? $attributes['title'] : '';
    $content = isset( $attributes['content'] ) ? $attributes['content'] : '';
    $icon = isset( $attributes['icon'] ) ? $attributes['icon'] : '';
    $dismissible = isset( $attributes['dismissible'] ) && $attributes['dismissible'];
    $show_icon = isset( $attributes['showIcon'] ) && $attributes['showIcon'];
    
    // Default icons for each type
    $default_icons = array(
        'primary'   => 'info-circle-fill',
        'secondary' => 'info-circle',
        'success'   => 'check-circle-fill',
        'danger'    => 'exclamation-triangle-fill',
        'warning'   => 'exclamation-circle-fill',
        'info'      => 'info-circle-fill',
        'light'     => 'lightbulb',
        'dark'      => 'moon-fill',
    );
    
    $icon_to_use = ! empty( $icon ) ? $icon : ( isset( $default_icons[ $type ] ) ? $default_icons[ $type ] : 'info-circle-fill' );
    
    $alert_class = 'alert alert-' . $type;
    if ( $dismissible ) {
        $alert_class .= ' alert-dismissible fade show';
    }
    $alert_class .= ' dthree-alert';
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr( $alert_class ); ?>" role="alert">
        <div class="d-flex align-items-start">
            <?php if ( $show_icon ) : ?>
                <div class="alert-icon me-3">
                    <i class="bi bi-<?php echo esc_attr( $icon_to_use ); ?>"></i>
                </div>
            <?php endif; ?>
            
            <div class="alert-content flex-grow-1">
                <?php if ( ! empty( $title ) ) : ?>
                    <h4 class="alert-heading"><?php echo esc_html( $title ); ?></h4>
                <?php endif; ?>
                
                <div class="alert-message">
                    <?php echo wp_kses_post( $content ); ?>
                </div>
            </div>
            
            <?php if ( $dismissible ) : ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
