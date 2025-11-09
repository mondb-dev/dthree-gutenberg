<?php
/**
 * Timeline Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Timeline Block
 */
function dthree_register_timeline_block() {
    register_block_type( 'dthree/timeline', array(
        'api_version' => 2,
        'title'       => __( 'Timeline', 'dthree-gutenberg' ),
        'description' => __( 'Display events in a chronological timeline', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'list-view',
        'keywords'    => array( 'timeline', 'history', 'events', 'chronological' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'events'         => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'date'        => '2024',
                        'title'       => __( 'Event Title', 'dthree-gutenberg' ),
                        'description' => __( 'Event description goes here', 'dthree-gutenberg' ),
                        'icon'        => 'star-fill',
                    ),
                    array(
                        'date'        => '2023',
                        'title'       => __( 'Another Event', 'dthree-gutenberg' ),
                        'description' => __( 'Another event description', 'dthree-gutenberg' ),
                        'icon'        => 'trophy-fill',
                    ),
                ),
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'vertical', // vertical, horizontal, alternating
            ),
            'iconStyle'      => array(
                'type'    => 'string',
                'default' => 'circle', // circle, square, none
            ),
        ),
        'render_callback' => 'dthree_render_timeline_block',
    ) );
}
add_action( 'init', 'dthree_register_timeline_block' );

/**
 * Render Timeline Block
 */
function dthree_render_timeline_block( $attributes ) {
    $events = isset( $attributes['events'] ) ? $attributes['events'] : array();
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'vertical';
    $icon_style = isset( $attributes['iconStyle'] ) ? $attributes['iconStyle'] : 'circle';
    
    if ( empty( $events ) ) {
        return '<div class="alert alert-info">' . __( 'Add timeline events to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    ob_start();
    ?>
    <div class="dthree-timeline timeline-<?php echo esc_attr( $style ); ?> icon-<?php echo esc_attr( $icon_style ); ?>">
        <?php foreach ( $events as $index => $event ) : 
            $position = $style === 'alternating' ? ( $index % 2 === 0 ? 'left' : 'right' ) : '';
        ?>
            <div class="timeline-item <?php echo esc_attr( $position ); ?>">
                <div class="timeline-marker">
                    <?php if ( ! empty( $event['icon'] ) ) : ?>
                        <i class="bi bi-<?php echo esc_attr( $event['icon'] ); ?>"></i>
                    <?php endif; ?>
                </div>
                
                <div class="timeline-content">
                    <?php if ( ! empty( $event['date'] ) ) : ?>
                        <span class="timeline-date"><?php echo esc_html( $event['date'] ); ?></span>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $event['title'] ) ) : ?>
                        <h4 class="timeline-title"><?php echo esc_html( $event['title'] ); ?></h4>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $event['description'] ) ) : ?>
                        <p class="timeline-description"><?php echo wp_kses_post( $event['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
