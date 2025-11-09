<?php
/**
 * Modal Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Modal Block
 */
function dthree_register_modal_block() {
    register_block_type( 'dthree/modal', array(
        'api_version' => 2,
        'title'       => __( 'Modal', 'dthree-gutenberg' ),
        'description' => __( 'Display content in a popup modal window', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'welcome-view-site',
        'keywords'    => array( 'modal', 'popup', 'dialog', 'lightbox' ),
        'supports'    => array(
            'align' => false,
        ),
        'attributes'  => array(
            'modalId'        => array(
                'type'    => 'string',
                'default' => '',
            ),
            'title'          => array(
                'type'    => 'string',
                'default' => __( 'Modal Title', 'dthree-gutenberg' ),
            ),
            'content'        => array(
                'type'    => 'string',
                'default' => __( 'Modal content goes here', 'dthree-gutenberg' ),
            ),
            'buttonText'     => array(
                'type'    => 'string',
                'default' => __( 'Open Modal', 'dthree-gutenberg' ),
            ),
            'buttonStyle'    => array(
                'type'    => 'string',
                'default' => 'primary',
            ),
            'size'           => array(
                'type'    => 'string',
                'default' => 'medium', // small, medium, large, extra-large
            ),
            'centered'       => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'backdrop'       => array(
                'type'    => 'string',
                'default' => 'true', // true, static, false
            ),
            'footerButtons'  => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'text'  => __( 'Close', 'dthree-gutenberg' ),
                        'style' => 'secondary',
                        'action' => 'close',
                    ),
                    array(
                        'text'  => __( 'Save Changes', 'dthree-gutenberg' ),
                        'style' => 'primary',
                        'action' => 'custom',
                    ),
                ),
            ),
        ),
        'render_callback' => 'dthree_render_modal_block',
    ) );
}
add_action( 'init', 'dthree_register_modal_block' );

/**
 * Render Modal Block
 */
function dthree_render_modal_block( $attributes ) {
    $modal_id = isset( $attributes['modalId'] ) && ! empty( $attributes['modalId'] ) 
        ? sanitize_title( $attributes['modalId'] ) 
        : 'modal-' . wp_rand( 1000, 9999 );
    
    $title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Modal Title', 'dthree-gutenberg' );
    $content = isset( $attributes['content'] ) ? $attributes['content'] : '';
    $button_text = isset( $attributes['buttonText'] ) ? $attributes['buttonText'] : __( 'Open Modal', 'dthree-gutenberg' );
    $button_style = isset( $attributes['buttonStyle'] ) ? $attributes['buttonStyle'] : 'primary';
    $size = isset( $attributes['size'] ) ? $attributes['size'] : 'medium';
    $centered = isset( $attributes['centered'] ) ? $attributes['centered'] : true;
    $backdrop = isset( $attributes['backdrop'] ) ? $attributes['backdrop'] : 'true';
    $footer_buttons = isset( $attributes['footerButtons'] ) ? $attributes['footerButtons'] : array();
    
    // Size mapping
    $size_class = '';
    switch ( $size ) {
        case 'small':
            $size_class = 'modal-sm';
            break;
        case 'large':
            $size_class = 'modal-lg';
            break;
        case 'extra-large':
            $size_class = 'modal-xl';
            break;
    }
    
    $dialog_class = 'modal-dialog';
    if ( $centered ) {
        $dialog_class .= ' modal-dialog-centered';
    }
    if ( $size_class ) {
        $dialog_class .= ' ' . $size_class;
    }
    
    ob_start();
    ?>
    <!-- Trigger Button -->
    <button type="button" 
            class="btn btn-<?php echo esc_attr( $button_style ); ?> dthree-modal-trigger" 
            data-bs-toggle="modal" 
            data-bs-target="#<?php echo esc_attr( $modal_id ); ?>">
        <?php echo esc_html( $button_text ); ?>
    </button>

    <!-- Modal -->
    <div class="modal fade" 
         id="<?php echo esc_attr( $modal_id ); ?>" 
         tabindex="-1" 
         aria-labelledby="<?php echo esc_attr( $modal_id ); ?>-label" 
         aria-hidden="true"
         data-bs-backdrop="<?php echo esc_attr( $backdrop ); ?>">
        <div class="<?php echo esc_attr( $dialog_class ); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?php echo esc_attr( $modal_id ); ?>-label">
                        <?php echo esc_html( $title ); ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <?php echo wp_kses_post( $content ); ?>
                </div>
                
                <?php if ( ! empty( $footer_buttons ) ) : ?>
                    <div class="modal-footer">
                        <?php foreach ( $footer_buttons as $btn ) : 
                            $btn_action = isset( $btn['action'] ) && $btn['action'] === 'close' 
                                ? 'data-bs-dismiss="modal"' 
                                : '';
                        ?>
                            <button type="button" 
                                    class="btn btn-<?php echo esc_attr( $btn['style'] ?? 'secondary' ); ?>"
                                    <?php echo $btn_action; ?>>
                                <?php echo esc_html( $btn['text'] ?? '' ); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
