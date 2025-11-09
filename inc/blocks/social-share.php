<?php
/**
 * Social Share Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Social Share Block
 */
function dthree_register_social_share_block() {
    register_block_type( 'dthree/social-share', array(
        'api_version' => 2,
        'title'       => __( 'Social Share', 'dthree-gutenberg' ),
        'description' => __( 'Share buttons for social media platforms', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'share',
        'keywords'    => array( 'social', 'share', 'facebook', 'twitter', 'linkedin' ),
        'supports'    => array(
            'align' => false,
        ),
        'attributes'  => array(
            'platforms'      => array(
                'type'    => 'array',
                'default' => array( 'facebook', 'twitter', 'linkedin', 'email' ),
            ),
            'style'          => array(
                'type'    => 'string',
                'default' => 'buttons', // buttons, icons, minimal
            ),
            'size'           => array(
                'type'    => 'string',
                'default' => 'medium', // small, medium, large
            ),
            'alignment'      => array(
                'type'    => 'string',
                'default' => 'left', // left, center, right
            ),
            'showLabels'     => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'showCounts'     => array(
                'type'    => 'boolean',
                'default' => false,
            ),
        ),
        'render_callback' => 'dthree_render_social_share_block',
    ) );
}
add_action( 'init', 'dthree_register_social_share_block' );

/**
 * Render Social Share Block
 */
function dthree_render_social_share_block( $attributes ) {
    $platforms = isset( $attributes['platforms'] ) ? $attributes['platforms'] : array( 'facebook', 'twitter', 'linkedin', 'email' );
    $style = isset( $attributes['style'] ) ? $attributes['style'] : 'buttons';
    $size = isset( $attributes['size'] ) ? $attributes['size'] : 'medium';
    $alignment = isset( $attributes['alignment'] ) ? $attributes['alignment'] : 'left';
    $show_labels = isset( $attributes['showLabels'] ) && $attributes['showLabels'];
    $show_counts = isset( $attributes['showCounts'] ) && $attributes['showCounts'];
    
    if ( empty( $platforms ) ) {
        return '<div class="alert alert-info">' . __( 'Select platforms to display share buttons', 'dthree-gutenberg' ) . '</div>';
    }
    
    // Get current page info
    $url = is_singular() ? get_permalink() : home_url( '/' );
    $title = is_singular() ? get_the_title() : get_bloginfo( 'name' );
    $title = rawurlencode( html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) );
    $url_encoded = rawurlencode( $url );
    
    // Platform configurations
    $platform_config = array(
        'facebook'  => array(
            'label' => __( 'Facebook', 'dthree-gutenberg' ),
            'icon'  => 'facebook',
            'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $url_encoded,
            'color' => '#1877f2',
        ),
        'twitter'   => array(
            'label' => __( 'Twitter', 'dthree-gutenberg' ),
            'icon'  => 'twitter-x',
            'url'   => 'https://twitter.com/intent/tweet?url=' . $url_encoded . '&text=' . $title,
            'color' => '#000000',
        ),
        'linkedin'  => array(
            'label' => __( 'LinkedIn', 'dthree-gutenberg' ),
            'icon'  => 'linkedin',
            'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url_encoded,
            'color' => '#0077b5',
        ),
        'pinterest' => array(
            'label' => __( 'Pinterest', 'dthree-gutenberg' ),
            'icon'  => 'pinterest',
            'url'   => 'https://pinterest.com/pin/create/button/?url=' . $url_encoded . '&description=' . $title,
            'color' => '#e60023',
        ),
        'reddit'    => array(
            'label' => __( 'Reddit', 'dthree-gutenberg' ),
            'icon'  => 'reddit',
            'url'   => 'https://reddit.com/submit?url=' . $url_encoded . '&title=' . $title,
            'color' => '#ff4500',
        ),
        'whatsapp'  => array(
            'label' => __( 'WhatsApp', 'dthree-gutenberg' ),
            'icon'  => 'whatsapp',
            'url'   => 'https://wa.me/?text=' . $title . '%20' . $url_encoded,
            'color' => '#25d366',
        ),
        'telegram'  => array(
            'label' => __( 'Telegram', 'dthree-gutenberg' ),
            'icon'  => 'telegram',
            'url'   => 'https://t.me/share/url?url=' . $url_encoded . '&text=' . $title,
            'color' => '#0088cc',
        ),
        'email'     => array(
            'label' => __( 'Email', 'dthree-gutenberg' ),
            'icon'  => 'envelope-fill',
            'url'   => 'mailto:?subject=' . $title . '&body=' . $url_encoded,
            'color' => '#6c757d',
        ),
    );
    
    $container_class = 'dthree-social-share share-' . $style . ' share-' . $size . ' text-' . $alignment;
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr( $container_class ); ?>">
        <div class="social-share-buttons">
            <?php foreach ( $platforms as $platform ) : 
                if ( ! isset( $platform_config[ $platform ] ) ) {
                    continue;
                }
                $config = $platform_config[ $platform ];
            ?>
                <a href="<?php echo esc_url( $config['url'] ); ?>" 
                   class="social-share-button share-<?php echo esc_attr( $platform ); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   aria-label="<?php echo esc_attr( sprintf( __( 'Share on %s', 'dthree-gutenberg' ), $config['label'] ) ); ?>"
                   style="--share-color: <?php echo esc_attr( $config['color'] ); ?>">
                    <i class="bi bi-<?php echo esc_attr( $config['icon'] ); ?>"></i>
                    <?php if ( $show_labels ) : ?>
                        <span class="share-label"><?php echo esc_html( $config['label'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( $show_counts ) : ?>
                        <span class="share-count">0</span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
