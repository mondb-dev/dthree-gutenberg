<?php
/**
 * Progress Bars Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Progress Bars Block
 */
function dthree_register_progress_bars_block() {
    register_block_type( 'dthree/progress-bars', array(
        'api_version' => 2,
        'title'       => __( 'Progress Bars', 'dthree-gutenberg' ),
        'description' => __( 'Display skills, stats, or progress with animated bars', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'chart-bar',
        'keywords'    => array( 'progress', 'skills', 'stats', 'bars', 'percentage' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'bars'           => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'label'      => __( 'WordPress', 'dthree-gutenberg' ),
                        'percentage' => 90,
                        'color'      => 'primary',
                    ),
                    array(
                        'label'      => __( 'PHP', 'dthree-gutenberg' ),
                        'percentage' => 85,
                        'color'      => 'success',
                    ),
                    array(
                        'label'      => __( 'JavaScript', 'dthree-gutenberg' ),
                        'percentage' => 80,
                        'color'      => 'info',
                    ),
                ),
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'default', // default, striped, animated
            ),
            'height'         => array(
                'type'    => 'string',
                'default' => 'medium', // small, medium, large
            ),
            'showPercentage' => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'animateOnView'  => array(
                'type'    => 'boolean',
                'default' => true,
            ),
        ),
        'render_callback' => 'dthree_render_progress_bars_block',
    ) );
}
add_action( 'init', 'dthree_register_progress_bars_block' );

/**
 * Render Progress Bars Block
 */
function dthree_render_progress_bars_block( $attributes ) {
    $bars = isset( $attributes['bars'] ) ? $attributes['bars'] : array();
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'default';
    $height = isset( $attributes['height'] ) ? $attributes['height'] : 'medium';
    $show_percentage = isset( $attributes['showPercentage'] ) ? $attributes['showPercentage'] : true;
    $animate_on_view = isset( $attributes['animateOnView'] ) ? $attributes['animateOnView'] : true;
    
    if ( empty( $bars ) ) {
        return '<div class="alert alert-info">' . __( 'Add progress bars to display', 'dthree-gutenberg' ) . '</div>';
    }
    
    $progress_id = 'dthree-progress-' . wp_rand( 1000, 9999 );
    $container_class = 'dthree-progress-bars progress-' . $height;
    
    if ( $animate_on_view ) {
        $container_class .= ' animate-on-view';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr( $container_class ); ?>" id="<?php echo esc_attr( $progress_id ); ?>">
        <?php foreach ( $bars as $index => $bar ) : 
            $percentage = isset( $bar['percentage'] ) ? absint( $bar['percentage'] ) : 0;
            $percentage = min( $percentage, 100 );
            $color = isset( $bar['color'] ) ? $bar['color'] : 'primary';
            
            $progress_class = 'progress';
            if ( $style === 'striped' || $style === 'animated' ) {
                $progress_class .= ' progress-bar-striped';
            }
            if ( $style === 'animated' ) {
                $progress_class .= ' progress-bar-animated';
            }
        ?>
            <div class="progress-item mb-3">
                <?php if ( ! empty( $bar['label'] ) ) : ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="progress-label"><?php echo esc_html( $bar['label'] ); ?></span>
                        <?php if ( $show_percentage ) : ?>
                            <span class="progress-percentage"><?php echo esc_html( $percentage ); ?>%</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="progress">
                    <div class="progress-bar bg-<?php echo esc_attr( $color ); ?> <?php echo esc_attr( $progress_class ); ?>" 
                         role="progressbar" 
                         style="width: <?php echo $animate_on_view ? '0' : $percentage; ?>%" 
                         data-percentage="<?php echo esc_attr( $percentage ); ?>"
                         aria-valuenow="<?php echo esc_attr( $percentage ); ?>" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        <?php if ( ! $show_percentage && ! empty( $bar['label'] ) ) : ?>
                            <span class="visually-hidden"><?php echo esc_html( $bar['label'] ); ?>: <?php echo esc_html( $percentage ); ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if ( $animate_on_view ) : ?>
        <script>
        (function() {
            const progressBars = document.querySelectorAll('#<?php echo esc_js( $progress_id ); ?> .progress-bar');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const percentage = bar.getAttribute('data-percentage');
                        setTimeout(() => {
                            bar.style.width = percentage + '%';
                        }, 100);
                        observer.unobserve(bar);
                    }
                });
            }, { threshold: 0.1 });
            
            progressBars.forEach(bar => observer.observe(bar));
        })();
        </script>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}
