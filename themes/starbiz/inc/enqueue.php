<?php
/**
 * Enqueue scripts and styles
 *
 * @package starbiz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function starbiz_theme_scripts() {
    // Theme main stylesheet (style.css in root)
    wp_enqueue_style( 'starbiz-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );

    // Custom CSS in assets/css/style.css
    wp_enqueue_style( 'starbiz-custom-style', get_template_directory_uri() . '/assets/css/style.css', array('starbiz-style'), wp_get_theme()->get('Version') );

    // Bootstrap CSS
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2' );

    // Bootstrap JS bundle
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true );

    // Custom JS
    wp_enqueue_script( 'starbiz-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'starbiz_theme_scripts' );
