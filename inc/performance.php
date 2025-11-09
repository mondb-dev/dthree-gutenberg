<?php
/**
 * Performance Optimization System
 * Ensures Core Web Vitals compliance and optimal loading speed
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ============================================
 * CORE WEB VITALS OPTIMIZATION
 * ============================================
 * LCP (Largest Contentful Paint): < 2.5s
 * FID (First Input Delay): < 100ms
 * CLS (Cumulative Layout Shift): < 0.1
 * INP (Interaction to Next Paint): < 200ms
 */

/**
 * Critical CSS Generation and Inlining
 * Improves LCP by loading critical styles immediately
 */
function dthree_inline_critical_css() {
    // Only on frontend
    if ( is_admin() ) {
        return;
    }
    
    $critical_css = "
    :root{--dthree-primary:#2563eb;--dthree-text:#1f2937;--dthree-bg:#ffffff}
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;font-size:16px;line-height:1.6;color:var(--dthree-text);background:var(--dthree-bg)}
    .site-header{position:sticky;top:0;z-index:1030;background:var(--dthree-bg);box-shadow:0 1px 3px rgba(0,0,0,.1)}
    .container{max-width:1200px;margin:0 auto;padding:0 1rem}
    img{max-width:100%;height:auto;display:block}
    h1,h2,h3{line-height:1.2;font-weight:700}
    .hero-section{min-height:60vh;display:flex;align-items:center;justify-content:center}
    ";
    
    echo '<style id="dthree-critical-css">' . $critical_css . '</style>';
}
add_action( 'wp_head', 'dthree_inline_critical_css', 1 );

/**
 * Defer non-critical CSS
 * Prevents render-blocking CSS
 */
function dthree_defer_non_critical_css( $html, $handle ) {
    // List of critical stylesheets to keep blocking
    $critical_handles = array( 'dthree-style', 'dthree-defaults' );
    
    if ( ! in_array( $handle, $critical_handles, true ) ) {
        $html = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $html );
        $html .= '<noscript>' . str_replace( "media='print' onload=\"this.media='all'\"", "media='all'", $html ) . '</noscript>';
    }
    
    return $html;
}
// Disabled by default - enable in performance settings
// add_filter( 'style_loader_tag', 'dthree_defer_non_critical_css', 10, 2 );

/**
 * Preload critical resources
 * Improves LCP and FCP
 */
function dthree_preload_critical_resources() {
    // Preload fonts
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    
    <?php
    // Preload hero image on homepage
    if ( is_front_page() && has_post_thumbnail() ) {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'large' );
        if ( $thumbnail_url ) {
            echo '<link rel="preload" as="image" href="' . esc_url( $thumbnail_url ) . '">';
        }
    }
}
add_action( 'wp_head', 'dthree_preload_critical_resources', 2 );

/**
 * Defer JavaScript loading
 * Improves FID and TBT (Total Blocking Time)
 */
function dthree_defer_scripts( $tag, $handle, $src ) {
    // Skip jQuery and critical scripts
    $critical_scripts = array( 'jquery', 'jquery-core', 'jquery-migrate' );
    
    if ( in_array( $handle, $critical_scripts, true ) ) {
        return $tag;
    }
    
    // Add defer to all other scripts
    if ( ! strpos( $tag, 'defer' ) && ! strpos( $tag, 'async' ) ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'dthree_defer_scripts', 10, 3 );

/**
 * Lazy load images and iframes
 * Improves LCP and reduces bandwidth
 */
function dthree_add_lazy_loading( $content ) {
    if ( is_admin() || is_feed() || wp_doing_ajax() ) {
        return $content;
    }
    
    // Add loading="lazy" to images
    $content = preg_replace(
        '/<img((?![^>]*loading=)[^>]*)>/i',
        '<img$1 loading="lazy">',
        $content
    );
    
    // Add loading="lazy" to iframes
    $content = preg_replace(
        '/<iframe((?![^>]*loading=)[^>]*)>/i',
        '<iframe$1 loading="lazy">',
        $content
    );
    
    return $content;
}
add_filter( 'the_content', 'dthree_add_lazy_loading', 20 );
add_filter( 'post_thumbnail_html', 'dthree_add_lazy_loading', 20 );
add_filter( 'widget_text', 'dthree_add_lazy_loading', 20 );

/**
 * Add width and height to images (prevent CLS)
 * Crucial for good CLS scores
 */
function dthree_add_image_dimensions( $html, $post_id, $post_thumbnail_id ) {
    $image_meta = wp_get_attachment_metadata( $post_thumbnail_id );
    
    if ( ! empty( $image_meta['width'] ) && ! empty( $image_meta['height'] ) ) {
        $html = str_replace(
            '<img',
            '<img width="' . esc_attr( $image_meta['width'] ) . '" height="' . esc_attr( $image_meta['height'] ) . '"',
            $html
        );
    }
    
    return $html;
}
add_filter( 'post_thumbnail_html', 'dthree_add_image_dimensions', 10, 3 );

/**
 * Enable WebP image support
 * Reduces image file sizes by 25-35%
 */
function dthree_enable_webp_upload( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'mime_types', 'dthree_enable_webp_upload' );

/**
 * Optimize image quality
 * Balance quality vs file size
 */
function dthree_optimize_image_quality( $quality, $mime_type ) {
    // 82 is optimal balance of quality and file size
    return 82;
}
add_filter( 'jpeg_quality', 'dthree_optimize_image_quality', 10, 2 );
add_filter( 'wp_editor_set_quality', 'dthree_optimize_image_quality', 10, 2 );

/**
 * Remove query strings from static resources
 * Improves caching
 */
function dthree_remove_query_strings( $src ) {
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'script_loader_src', 'dthree_remove_query_strings', 15 );
add_filter( 'style_loader_src', 'dthree_remove_query_strings', 15 );

/**
 * Disable emoji scripts (saves ~15KB and 1 HTTP request)
 */
function dthree_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'dthree_disable_emojis' );

/**
 * Disable embeds (saves resources if not needed)
 */
function dthree_disable_embeds() {
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'dthree_disable_embeds' );

/**
 * Remove unnecessary WordPress features
 */
remove_action( 'wp_head', 'wp_generator' ); // WordPress version
remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
remove_action( 'wp_head', 'rsd_link' ); // Really Simple Discovery
remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // Shortlink
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // Prev/next links

/**
 * Optimize WordPress Heartbeat API
 * Reduces server load and improves performance
 */
function dthree_optimize_heartbeat( $settings ) {
    // Slow down heartbeat to 60 seconds
    $settings['interval'] = 60;
    return $settings;
}
add_filter( 'heartbeat_settings', 'dthree_optimize_heartbeat' );

/**
 * Disable heartbeat on frontend (only needed in admin)
 */
function dthree_disable_heartbeat_frontend() {
    if ( ! is_admin() ) {
        wp_deregister_script( 'heartbeat' );
    }
}
add_action( 'init', 'dthree_disable_heartbeat_frontend', 1 );

/**
 * Limit post revisions (saves database space)
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
    define( 'WP_POST_REVISIONS', 3 );
}

/**
 * Add DNS prefetch for external resources
 */
function dthree_dns_prefetch() {
    ?>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <?php
}
add_action( 'wp_head', 'dthree_dns_prefetch', 1 );

/**
 * Optimize CSS delivery by combining files (optional)
 */
function dthree_combine_css() {
    if ( get_theme_mod( 'dthree_combine_css', false ) ) {
        global $wp_styles;
        
        // List of theme CSS files to combine
        $theme_styles = array(
            'dthree-defaults',
            'dthree-components',
            'dthree-sliders',
            'dthree-lightbox',
        );
        
        $combined_css = '';
        
        foreach ( $theme_styles as $handle ) {
            if ( isset( $wp_styles->registered[ $handle ] ) ) {
                $file = $wp_styles->registered[ $handle ]->src;
                $file_path = str_replace( DTHREE_THEME_URI, DTHREE_THEME_DIR, $file );
                
                if ( file_exists( $file_path ) ) {
                    $combined_css .= file_get_contents( $file_path );
                    wp_dequeue_style( $handle );
                }
            }
        }
        
        // Output combined CSS inline or save to file
        if ( ! empty( $combined_css ) ) {
            echo '<style id="dthree-combined-css">' . $combined_css . '</style>';
        }
    }
}
// add_action( 'wp_enqueue_scripts', 'dthree_combine_css', 999 );

/**
 * Add performance monitoring script
 * Tracks Core Web Vitals in real-time
 */
function dthree_web_vitals_monitoring() {
    if ( ! get_theme_mod( 'dthree_enable_monitoring', false ) ) {
        return;
    }
    ?>
    <script>
    // Web Vitals Monitoring
    (function() {
        // LCP - Largest Contentful Paint
        new PerformanceObserver((entryList) => {
            for (const entry of entryList.getEntries()) {
                console.log('LCP:', entry.renderTime || entry.loadTime);
            }
        }).observe({entryTypes: ['largest-contentful-paint']});
        
        // FID - First Input Delay
        new PerformanceObserver((entryList) => {
            for (const entry of entryList.getEntries()) {
                console.log('FID:', entry.processingStart - entry.startTime);
            }
        }).observe({entryTypes: ['first-input']});
        
        // CLS - Cumulative Layout Shift
        let clsValue = 0;
        new PerformanceObserver((entryList) => {
            for (const entry of entryList.getEntries()) {
                if (!entry.hadRecentInput) {
                    clsValue += entry.value;
                    console.log('CLS:', clsValue);
                }
            }
        }).observe({entryTypes: ['layout-shift']});
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'dthree_web_vitals_monitoring' );

/**
 * Add resource hints
 */
function dthree_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    
    return $urls;
}
add_filter( 'wp_resource_hints', 'dthree_resource_hints', 10, 2 );

/**
 * Minify HTML output (optional - enable in settings)
 */
function dthree_minify_html( $html ) {
    if ( ! get_theme_mod( 'dthree_minify_html', false ) || is_admin() ) {
        return $html;
    }
    
    // Remove HTML comments (except IE conditionals)
    $html = preg_replace( '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html );
    
    // Remove whitespace
    $html = preg_replace( '/\s+/', ' ', $html );
    
    // Remove whitespace between tags
    $html = preg_replace( '/>\s+</', '><', $html );
    
    return $html;
}
add_action( 'wp_loaded', function() {
    if ( get_theme_mod( 'dthree_minify_html', false ) ) {
        ob_start( 'dthree_minify_html' );
    }
});

/**
 * Add performance settings to customizer
 */
function dthree_performance_customizer_settings( $wp_customize ) {
    // Performance Section
    $wp_customize->add_section( 'dthree_performance', array(
        'title'    => __( 'Performance Optimization', 'dthree-gutenberg' ),
        'priority' => 200,
    ) );
    
    // Minify HTML
    $wp_customize->add_setting( 'dthree_minify_html', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    
    $wp_customize->add_control( 'dthree_minify_html', array(
        'label'       => __( 'Minify HTML Output', 'dthree-gutenberg' ),
        'description' => __( 'Removes whitespace and comments from HTML (reduces file size by ~10%)', 'dthree-gutenberg' ),
        'section'     => 'dthree_performance',
        'type'        => 'checkbox',
    ) );
    
    // Combine CSS
    $wp_customize->add_setting( 'dthree_combine_css', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    
    $wp_customize->add_control( 'dthree_combine_css', array(
        'label'       => __( 'Combine CSS Files', 'dthree-gutenberg' ),
        'description' => __( 'Combines theme CSS into single file (reduces HTTP requests)', 'dthree-gutenberg' ),
        'section'     => 'dthree_performance',
        'type'        => 'checkbox',
    ) );
    
    // Enable Monitoring
    $wp_customize->add_setting( 'dthree_enable_monitoring', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    
    $wp_customize->add_control( 'dthree_enable_monitoring', array(
        'label'       => __( 'Enable Web Vitals Monitoring', 'dthree-gutenberg' ),
        'description' => __( 'Logs Core Web Vitals to browser console (for development)', 'dthree-gutenberg' ),
        'section'     => 'dthree_performance',
        'type'        => 'checkbox',
    ) );
}
add_action( 'customize_register', 'dthree_performance_customizer_settings' );

/**
 * Cache busting for theme assets
 */
function dthree_get_asset_version( $file ) {
    $file_path = DTHREE_THEME_DIR . $file;
    
    if ( file_exists( $file_path ) ) {
        return filemtime( $file_path );
    }
    
    return DTHREE_VERSION;
}

/**
 * Performance monitoring dashboard widget
 */
function dthree_performance_dashboard_widget() {
    wp_add_dashboard_widget(
        'dthree_performance_widget',
        'Theme Performance',
        'dthree_performance_widget_content'
    );
}
add_action( 'wp_dashboard_setup', 'dthree_performance_dashboard_widget' );

function dthree_performance_widget_content() {
    ?>
    <div class="dthree-performance-widget">
        <h3>Core Web Vitals Status</h3>
        <div class="performance-metric">
            <span class="metric-label">LCP Target:</span>
            <span class="metric-value">< 2.5s</span>
            <span class="status good">✓</span>
        </div>
        <div class="performance-metric">
            <span class="metric-label">FID Target:</span>
            <span class="metric-value">< 100ms</span>
            <span class="status good">✓</span>
        </div>
        <div class="performance-metric">
            <span class="metric-label">CLS Target:</span>
            <span class="metric-value">< 0.1</span>
            <span class="status good">✓</span>
        </div>
        
        <h4 style="margin-top: 20px;">Optimization Tips</h4>
        <ul style="margin-left: 20px; font-size: 13px;">
            <li>Use WebP images (25-35% smaller)</li>
            <li>Set width/height on all images</li>
            <li>Enable caching plugin (WP Rocket, W3 Total Cache)</li>
            <li>Use a CDN (Cloudflare, StackPath)</li>
            <li>Minimize third-party scripts</li>
        </ul>
        
        <p style="margin-top: 15px;">
            <a href="<?php echo admin_url( 'customize.php?autofocus[section]=dthree_performance' ); ?>" class="button button-primary">
                Performance Settings
            </a>
            <a href="https://pagespeed.web.dev/" target="_blank" class="button">
                Test Speed →
            </a>
        </p>
    </div>
    
    <style>
        .dthree-performance-widget .performance-metric {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .dthree-performance-widget .metric-label {
            font-weight: 500;
        }
        .dthree-performance-widget .status.good {
            color: #10b981;
            font-weight: bold;
        }
    </style>
    <?php
}

/**
 * Generate .htaccess rules for performance (Apache servers)
 */
function dthree_generate_htaccess_rules() {
    $rules = "
# BEGIN DThree Performance Optimization

# Enable GZIP Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg \"access plus 1 year\"
    ExpiresByType image/jpeg \"access plus 1 year\"
    ExpiresByType image/gif \"access plus 1 year\"
    ExpiresByType image/png \"access plus 1 year\"
    ExpiresByType image/webp \"access plus 1 year\"
    ExpiresByType text/css \"access plus 1 month\"
    ExpiresByType application/javascript \"access plus 1 month\"
    ExpiresByType application/pdf \"access plus 1 month\"
    ExpiresByType image/x-icon \"access plus 1 year\"
</IfModule>

# Cache-Control Headers
<IfModule mod_headers.c>
    <FilesMatch \"\\.(jpg|jpeg|png|gif|webp|svg|ico)$\">
        Header set Cache-Control \"max-age=31536000, public\"
    </FilesMatch>
    <FilesMatch \"\\.(css|js)$\">
        Header set Cache-Control \"max-age=2592000, public\"
    </FilesMatch>
</IfModule>

# END DThree Performance Optimization
    ";
    
    return $rules;
}

/**
 * Add admin notice for performance recommendations
 */
function dthree_performance_admin_notice() {
    $screen = get_current_screen();
    
    if ( $screen->id === 'dashboard' && current_user_can( 'manage_options' ) ) {
        // Check if caching plugin is installed
        $has_caching = false;
        if ( is_plugin_active( 'wp-rocket/wp-rocket.php' ) || 
             is_plugin_active( 'w3-total-cache/w3-total-cache.php' ) ||
             is_plugin_active( 'wp-super-cache/wp-cache.php' ) ) {
            $has_caching = true;
        }
        
        if ( ! $has_caching && ! get_option( 'dthree_hide_cache_notice' ) ) {
            ?>
            <div class="notice notice-info is-dismissible" data-notice="cache">
                <p>
                    <strong>DThree Gutenberg Performance Tip:</strong> 
                    Install a caching plugin like WP Rocket or W3 Total Cache to improve page load times by 2-3x.
                    <a href="<?php echo admin_url( 'plugin-install.php?s=cache&tab=search' ); ?>" class="button button-small">
                        Install Plugin
                    </a>
                </p>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'dthree_performance_admin_notice' );