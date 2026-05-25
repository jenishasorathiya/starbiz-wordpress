<?php
/**
 * Theme setup
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function starbiz_theme_setup() {

    // Title tag support, Featured images
    add_theme_support( 'title-tag' , 'post-thumbnails' );

    // Custom logo
    
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // HTML5 support
    add_theme_support( 'html5', ['search-form','comment-form','comment-list','gallery','caption','style','script'] );

    //logo
    add_theme_support( 'custom-logo' );

    // Menus
    register_nav_menus([
        'primary' => __( 'Primary Menu', 'starbiz' ),
        'footer'  => __( 'Footer Menu', 'starbiz' ),
    ]);
}
add_action( 'after_setup_theme', 'starbiz_theme_setup' );


//theme option
function starbiz_add_builder_menu() {
    add_menu_page(
        'starbiz Builder',              // Page title
        'starbiz Builder',              // Menu title
        'manage_options',              // Capability
        'starbiz_builder_dashboard',    // Menu slug
        'starbiz_builder_welcome_page', // Callback function
        'dashicons-admin-generic',     // Icon (you can change it)
        3                             // Position
    );
}
add_action('admin_menu', 'starbiz_add_builder_menu');

function starbiz_builder_welcome_page() {
    echo '<h1>Welcome to the Header and Footer Builder of this theme</h1>';
}



/**
 * Register CPT for Elementor headers
 */
function starbiz_register_header_cpt() {
    $labels = array(
        'name' => 'Headers',
        'singular_name' => 'Header',
        'menu_name' => 'Headers',
        'add_new_item' => 'Add New Header',
        'edit_item' => 'Edit Header',
    );

    $args = array(
        'label' => 'Header',
        'labels' => $labels,
        'supports' => array('title','editor','elementor'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'starbiz_builder_dashboard',
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-generic',
        'has_archive' => false,
        'rewrite' => array('slug'=>'starbiz_header','with_front'=>false),
        'exclude_from_search' => true,
    );

    register_post_type('starbiz_header', $args);
}
add_action('init','starbiz_register_header_cpt');

if(!function_exists('starbiz_header_cb')){
    function starbiz_header_cb() {
        global $opt_name;

        $active_header_id = Redux::get_Option($opt_name, 'active_header', false);

        if($active_header_id && class_exists('Elementor\Plugin')){
            // Render Elementor Header CPT
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_header_id);
        } else {
            // Optional fallback if no header selected
            echo '<!-- No header selected in Redux -->';
        }
    }
}
add_action('starbiz_header', 'starbiz_header_cb', 10);


/**
 * Register CPT for Elementor footers
 */
function starbiz_register_footer_cpt() {
    $labels = array(
        'name' => 'Footers',
        'singular_name' => 'Footer',
        'menu_name' => 'Footers',
        'add_new_item' => 'Add New Footer',
        'edit_item' => 'Edit Footer',
    );

    $args = array(
        'label' => 'Footer',
        'labels' => $labels,
        'supports' => array('title','editor','elementor'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'starbiz_builder_dashboard',
        'menu_position' => 20,
        'menu_icon' => 'dashicons-editor-kitchensink',
        'has_archive' => false,
        'rewrite' => array('slug'=>'starbiz_footer','with_front'=>false),
        'exclude_from_search' => true,
    );

    register_post_type('starbiz_footer', $args);
}
add_action('init','starbiz_register_footer_cpt');

if(!function_exists('starbiz_footer_cb')){
    function starbiz_footer_cb() {
        global $opt_name;

        $active_footer_id = Redux::get_Option($opt_name, 'active_footer', false);

        if($active_footer_id && class_exists('Elementor\Plugin')){
            // Render Elementor Header CPT
            echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_footer_id);
        } else {
            // Optional fallback if no header selected
            echo '<!-- No footer selected in Redux -->';
        }
    }
}
add_action('starbiz_footer', 'starbiz_footer_cb', 10);


//typography
function starbiz_custom_typography() {
    global $starbiz_options;

    if( isset($starbiz_options['body_font']) ) {
        $body_font = $starbiz_options['body_font']['font-family'];
        $body_size = $starbiz_options['body_font']['font-size'];
        $body_weight = $starbiz_options['body_font']['font-weight'];

        echo "<style>
            body {
                font-family: {$body_font};
                font-size: {$body_size};
                font-weight: {$body_weight};
            }
        </style>";
    }
}
add_action('wp_head', 'starbiz_custom_typography');


//color
function starbiz_custom_colors() {
    global $starbiz_options;

    if( isset($starbiz_options['primary_color']) ) {
        $primary   = $starbiz_options['primary_color'];
        $secondary = $starbiz_options['secondary_color'];
        $text      = $starbiz_options['text_color'];
        $accent    = $starbiz_options['accent_color'];

        echo "<style>
            body { color: {$text}; }
            a, .link { color: {$primary}; }
            .btn-secondary { background-color: {$secondary}; }
            .accent, .highlight { color: {$accent}; }
        </style>";
    }
}
add_action('wp_head', 'starbiz_custom_colors');

function starbiz_load_textdomain() {
    load_theme_textdomain( 'starbiz', get_template_directory() . '/languages' );
}
add_action( 'init', 'starbiz_load_textdomain' );