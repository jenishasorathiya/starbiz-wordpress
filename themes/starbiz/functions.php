<?php
/**
 * Theme functions and definitions
 *
 * @package starbiz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Hide PHP warnings and notices for end users
 * (safe for production themes)
 */
if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG === false ) {
    // Force-disable error display
    @ini_set( 'display_errors', 0 );
    @ini_set( 'display_startup_errors', 0 );
    error_reporting(0);
} else {
    // For developers, keep errors but not notices
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
}

/**
 * Also suppress warnings/notices in admin pages.
 * (Ensures even dashboard stays clean for clients)
 */
add_action( 'admin_init', function() {
    @ini_set( 'display_errors', 0 );
    @ini_set( 'display_startup_errors', 0 );
    error_reporting(0);
}, 1 );

/**
 * Extra safety for frontend init (in case other plugins change error settings)
 */
add_action( 'init', function() {
    if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG === false ) {
        @ini_set( 'display_errors', 0 );
        @ini_set( 'display_startup_errors', 0 );
        error_reporting(0);
    }
}, 1 );



require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/extra.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/cpt-case-studies.php';
require_once get_template_directory() . '/inc/tgmpa.php';
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/plugins-setting-page.php';


if ( ! function_exists( 'starbiz_get_option' ) ) {
    function starbiz_get_option( $key, $default = false ) {
        $options = get_option( 'starbiz_options' );
        return isset( $options[ $key ] ) ? $options[ $key ] : $default;
    }
}

/**
 * Force "Post name" permalink structure automatically.
 */
add_action( 'after_switch_theme', 'starbiz_set_postname_permalink' );
function starbiz_set_postname_permalink() {
    global $wp_rewrite;
    
    // Set permalink structure to /%postname%/
    $wp_rewrite->set_permalink_structure( '/%postname%/' );

    // Save the changes
    $wp_rewrite->flush_rules( true );

    error_log('✅ Permalink structure set to /%postname%/ after theme activation.');
}