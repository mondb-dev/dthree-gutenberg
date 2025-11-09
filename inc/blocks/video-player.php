<?php
/**
 * Video Player Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Video Player Block
 */
function dthree_register_video_player_block() {
    register_block_type( 'dthree/video-player', array(
        'api_version' => 2,
        'title'       => __( 'Video Player', 'dthree-gutenberg' ),
        'description' => __( 'Embed YouTube, Vimeo, or self-hosted videos', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'video-alt3',
        'keywords'    => array( 'video', 'player', 'youtube', 'vimeo', 'embed' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'videoType'      => array(
                'type'    => 'string',
                'default' => 'youtube', // youtube, vimeo, self-hosted
            ),
            'videoUrl'       => array(
                'type'    => 'string',
                'default' => '',
            ),
            'videoId'        => array(
                'type'    => 'string',
                'default' => '',
            ),
            'aspectRatio'    => array(
                'type'    => 'string',
                'default' => '16x9', // 16x9, 4x3, 21x9, 1x1
            ),
            'autoplay'       => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'controls'       => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'muted'          => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'loop'           => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'thumbnail'      => array(
                'type'    => 'string',
                'default' => '',
            ),
            'title'          => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
        'render_callback' => 'dthree_render_video_player_block',
    ) );
}
add_action( 'init', 'dthree_register_video_player_block' );

/**
 * Render Video Player Block
 */
function dthree_render_video_player_block( $attributes ) {
    $video_type = isset( $attributes['videoType'] ) ? $attributes['videoType'] : 'youtube';
    $video_url = isset( $attributes['videoUrl'] ) ? $attributes['videoUrl'] : '';
    $video_id = isset( $attributes['videoId'] ) ? $attributes['videoId'] : '';
    $aspect_ratio = isset( $attributes['aspectRatio'] ) ? $attributes['aspectRatio'] : '16x9';
    $autoplay = isset( $attributes['autoplay'] ) && $attributes['autoplay'] ? 1 : 0;
    $controls = isset( $attributes['controls'] ) && $attributes['controls'] ? 1 : 0;
    $muted = isset( $attributes['muted'] ) && $attributes['muted'] ? 1 : 0;
    $loop = isset( $attributes['loop'] ) && $attributes['loop'] ? 1 : 0;
    $thumbnail = isset( $attributes['thumbnail'] ) ? $attributes['thumbnail'] : '';
    $title = isset( $attributes['title'] ) ? $attributes['title'] : '';
    
    // Extract video ID from URL if not provided
    if ( empty( $video_id ) && ! empty( $video_url ) ) {
        if ( $video_type === 'youtube' ) {
            preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches );
            $video_id = isset( $matches[1] ) ? $matches[1] : '';
        } elseif ( $video_type === 'vimeo' ) {
            preg_match( '/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|)(\d+)/', $video_url, $matches );
            $video_id = isset( $matches[1] ) ? $matches[1] : '';
        }
    }
    
    ob_start();
    ?>
    <div class="dthree-video-player ratio ratio-<?php echo esc_attr( $aspect_ratio ); ?>">
        <?php if ( $video_type === 'youtube' && ! empty( $video_id ) ) : 
            $params = array(
                'autoplay' => $autoplay,
                'controls' => $controls,
                'mute'     => $muted,
                'loop'     => $loop,
            );
            if ( $loop ) {
                $params['playlist'] = $video_id;
            }
            $query_string = http_build_query( $params );
        ?>
            <iframe 
                src="https://www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?<?php echo esc_attr( $query_string ); ?>" 
                title="<?php echo esc_attr( $title ?: 'YouTube video player' ); ?>" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
            
        <?php elseif ( $video_type === 'vimeo' && ! empty( $video_id ) ) : 
            $params = array(
                'autoplay' => $autoplay,
                'muted'    => $muted,
                'loop'     => $loop,
            );
            $query_string = http_build_query( $params );
        ?>
            <iframe 
                src="https://player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?<?php echo esc_attr( $query_string ); ?>" 
                title="<?php echo esc_attr( $title ?: 'Vimeo video player' ); ?>" 
                frameborder="0" 
                allow="autoplay; fullscreen; picture-in-picture" 
                allowfullscreen>
            </iframe>
            
        <?php elseif ( $video_type === 'self-hosted' && ! empty( $video_url ) ) : ?>
            <video 
                controls="<?php echo $controls ? 'controls' : ''; ?>" 
                <?php echo $autoplay ? 'autoplay' : ''; ?> 
                <?php echo $muted ? 'muted' : ''; ?> 
                <?php echo $loop ? 'loop' : ''; ?>
                <?php echo ! empty( $thumbnail ) ? 'poster="' . esc_url( $thumbnail ) . '"' : ''; ?>>
                <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                <?php echo esc_html__( 'Your browser does not support the video tag.', 'dthree-gutenberg' ); ?>
            </video>
            
        <?php else : ?>
            <div class="alert alert-warning">
                <?php echo esc_html__( 'Please provide a valid video URL or ID', 'dthree-gutenberg' ); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
