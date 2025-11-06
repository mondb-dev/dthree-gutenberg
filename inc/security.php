<?php
/**
 * Security Functions
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove WordPress version from RSS feeds
 */
function dthree_remove_version_rss() {
    return '';
}
add_filter( 'the_generator', 'dthree_remove_version_rss' );

/**
 * Remove WordPress version from scripts and styles
 */
function dthree_remove_version_scripts_styles( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'dthree_remove_version_scripts_styles', 9999 );
add_filter( 'script_loader_src', 'dthree_remove_version_scripts_styles', 9999 );

/**
 * Add security headers
 */
function dthree_add_security_headers() {
    // Prevent clickjacking
    header( 'X-Frame-Options: SAMEORIGIN' );
    
    // Prevent MIME type sniffing
    header( 'X-Content-Type-Options: nosniff' );
    
    // Enable XSS protection
    header( 'X-XSS-Protection: 1; mode=block' );
    
    // Referrer policy
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}
add_action( 'send_headers', 'dthree_add_security_headers' );

/**
 * Disable file editing in dashboard
 */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
    define( 'DISALLOW_FILE_EDIT', true );
}

/**
 * Sanitize file upload names
 */
function dthree_sanitize_file_name( $filename ) {
    // Remove special characters
    $filename = preg_replace( '/[^A-Za-z0-9\-\_\.]/', '', $filename );
    
    // Remove multiple dots
    $filename = preg_replace( '/\.+/', '.', $filename );
    
    return $filename;
}
add_filter( 'sanitize_file_name', 'dthree_sanitize_file_name', 10 );

/**
 * Limit login attempts (basic implementation)
 */
function dthree_check_attempted_login( $user, $username, $password ) {
    if ( ! empty( $username ) && ! empty( $password ) ) {
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
        $transient_name = 'dthree_login_attempts_' . md5( $ip_address );
        
        $login_attempts = get_transient( $transient_name );
        
        if ( false === $login_attempts ) {
            $login_attempts = 0;
        }
        
        // Check if user is blocked
        if ( $login_attempts >= 5 ) {
            return new WP_Error(
                'too_many_attempts',
                __( 'Too many failed login attempts. Please try again in 15 minutes.', 'dthree-gutenberg' )
            );
        }
    }
    
    return $user;
}
add_filter( 'authenticate', 'dthree_check_attempted_login', 30, 3 );

/**
 * Track failed login attempts
 */
function dthree_login_failed( $username ) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
    $transient_name = 'dthree_login_attempts_' . md5( $ip_address );
    
    $login_attempts = get_transient( $transient_name );
    
    if ( false === $login_attempts ) {
        $login_attempts = 0;
    }
    
    $login_attempts++;
    set_transient( $transient_name, $login_attempts, 15 * MINUTE_IN_SECONDS );
}
add_action( 'wp_login_failed', 'dthree_login_failed' );

/**
 * Reset login attempts on successful login
 */
function dthree_login_success( $username ) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
    $transient_name = 'dthree_login_attempts_' . md5( $ip_address );
    delete_transient( $transient_name );
}
add_action( 'wp_login', 'dthree_login_success' );

/**
 * Disable REST API for non-authenticated users (optional - commented out by default)
 */
/*
function dthree_disable_rest_api( $access ) {
    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_disabled',
            __( 'REST API is disabled for non-authenticated users.', 'dthree-gutenberg' ),
            array( 'status' => 401 )
        );
    }
    return $access;
}
add_filter( 'rest_authentication_errors', 'dthree_disable_rest_api' );
*/

/**
 * Add Content Security Policy (commented out by default - customize as needed)
 */
/*
function dthree_add_csp_header() {
    header( "Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https:; font-src 'self' data: https://cdn.jsdelivr.net;" );
}
add_action( 'send_headers', 'dthree_add_csp_header' );
*/

/**
 * Validate and sanitize custom block attributes
 */
function dthree_sanitize_block_attribute( $value, $type = 'text' ) {
    switch ( $type ) {
        case 'text':
            return sanitize_text_field( $value );
        case 'textarea':
            return sanitize_textarea_field( $value );
        case 'email':
            return sanitize_email( $value );
        case 'url':
            return esc_url_raw( $value );
        case 'html':
            return wp_kses_post( $value );
        case 'number':
            return absint( $value );
        default:
            return sanitize_text_field( $value );
    }
}

/**
 * Check for insecure content in posts/pages
 */
function dthree_check_insecure_content( $content ) {
    // Convert any http:// to https:// for images, scripts, and styles if site uses HTTPS
    if ( is_ssl() ) {
        $content = str_replace( 'http://', 'https://', $content );
    }
    return $content;
}
add_filter( 'the_content', 'dthree_check_insecure_content' );

/**
 * Remove query strings from static resources (for better caching)
 */
function dthree_remove_query_strings( $src ) {
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'script_loader_src', 'dthree_remove_query_strings', 15, 1 );
add_filter( 'style_loader_src', 'dthree_remove_query_strings', 15, 1 );

/**
 * Validate nonce for AJAX requests
 */
function dthree_verify_ajax_nonce() {
    if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'dthree-nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security verification failed.', 'dthree-gutenberg' ) ) );
        wp_die();
    }
}
