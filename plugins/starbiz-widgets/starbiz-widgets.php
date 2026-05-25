<?php
/**
 * Plugin Name: StarBiz Widgets
 * Description: Elementor-supported widgets with full editing control, custom animations, and flexible design options.
 * Version: 1.0.1
 * Text Domain: starbiz
 * Tested up to: 6.8.3
 * Author: Rising Star Infotech
 * Author URI: https://risingstarinfotech.com
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin constants
define( 'STARBIZ_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'STARBIZ_WIDGETS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Schedule image import on plugin activation
 */
register_activation_hook( __FILE__, function() {
    add_option( 'starbiz_run_image_import', true );
});

/**
 * Import default images once
 */
add_action( 'init', function() {
    if ( ! get_option( 'starbiz_run_image_import' ) ) return;
    delete_option( 'starbiz_run_image_import' );

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $images = [
        'logo'           => 'widgets/assets/images/demo1/logo.png',
        'main'           => 'widgets/assets/images/demo1/main.png',
        'bg'             => 'widgets/assets/images/demo1/bg.png',
        'icon'           => 'widgets/assets/images/demo1/icon.png',
        'team'           => 'widgets/assets/images/demo1/team.png',
        'business'       => 'widgets/assets/images/demo1/business.png',
        'star'           => 'widgets/assets/images/demo1/star.png',
        'arrow_link'     => 'widgets/assets/images/demo1/arrow_link.png',
        'frame'          => 'widgets/assets/images/demo1/frame.png',
        'quote'          => 'widgets/assets/images/demo1/quote.png',
        'person'         => 'widgets/assets/images/demo1/person.png',
        'counter'        => 'widgets/assets/images/demo1/counter.png',
        'multi1'         => 'widgets/assets/images/demo1/multi1.png',
        'multi2'         => 'widgets/assets/images/demo1/multi2.png',
        'round-img'      => 'widgets/assets/images/demo1/circle-img.png',
        'dots-img'       => 'widgets/assets/images/demo1/dots-img.png',
        'first'          => 'widgets/assets/images/demo1/first.png',
        'second'         => 'widgets/assets/images/demo1/second.png',
        'service-img1'   => 'widgets/assets/images/demo1/service-img1.png',
        'service-dots'   => 'widgets/assets/images/demo1/service-dots.png',
    ];

    $upload_dir = wp_upload_dir();

    foreach ( $images as $name => $relative_path ) {
        $file_path = STARBIZ_WIDGETS_PATH . $relative_path;
        if ( ! file_exists( $file_path ) ) continue;

        // Skip if already imported
        $existing = get_posts([
            'post_type'      => 'attachment',
            'meta_key'       => '_starbiz_image_name',
            'meta_value'     => $name,
            'posts_per_page' => 1,
        ]);
        if ( $existing ) continue;

        $dest_path = $upload_dir['path'] . '/' . basename( $file_path );
        if ( ! copy( $file_path, $dest_path ) ) continue;

        $filetype = wp_check_filetype( basename( $dest_path ), null );

        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . basename( $dest_path ),
            'post_mime_type' => $filetype['type'],
            'post_title'     => ucfirst( $name ),
            'post_status'    => 'inherit',
        ];

        $attach_id = wp_insert_attachment( $attachment, $dest_path );
        if ( ! is_wp_error( $attach_id ) ) {
            $attach_data = wp_generate_attachment_metadata( $attach_id, $dest_path );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            update_post_meta( $attach_id, '_starbiz_image_name', $name );
        }
    }
});

/**
 * Initialize plugin after Elementor is loaded
 */
add_action( 'plugins_loaded', function() {

    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action('admin_notices', function(){
            echo '<div class="notice notice-error"><p><strong>StarBiz Widgets:</strong> Elementor is required.</p></div>';
        });
        return;
    }

    // Add Elementor category
    add_action('elementor/elements/categories_registered', function($elements_manager) {
        $elements_manager->add_category('demo1-widgets', [
            'title' => __('StarBiz Widgets', 'starbiz'),
            'icon'  => 'fa fa-plug',
        ]);
    });

    // Enqueue editor styles
    add_action( 'elementor/editor/after_enqueue_styles', function() {
        wp_enqueue_style( 'demo1-admin-icons', STARBIZ_WIDGETS_URL . 'widgets/assets/css/admin-icons.css', [], '1.0.0' );
    });

    // Register widgets
    add_action('elementor/widgets/register', function($widgets_manager) {
        $widgets = [
            'demo1-nav-menu.php'         => 'Demo1_Nav_Menu_Widget',
            'demo1-hero-headings.php'    => 'Hero_Headings_Widget',
            'demo1-button.php'           => 'Button_Widget',
            'demo1-hero-image.php'       => 'Hero_Image_Widget',
            'demo1-headings.php'         => 'Headings_Widget',
            'demo1-subscribe-form.php'   => 'Subscribe_Form_Widget',
            'demo1-service-box.php'      => 'Service_Box_Widget',
            'demo1-icon-box.php'         => 'Icon_Box_Widget',
            'demo1-image-box.php'        => 'Image_Box_Widget',
            'demo1-fancy-box.php'        => 'Fancy_Box_Widget',
            'demo1-counter.php'          => 'Counter_Widget',
            'demo1-testimonial.php'      => 'Testimonial_Slider_Widget',
            'demo1-team.php'             => 'Team_Widget',
            'demo1-post-widget.php'      => 'Demo1_Posts_Widget',
            'demo1-image-carousel.php'   => 'Gallery_Slider_Widget',
            'demo1-accordion.php'        => 'Accordion_Widget',
            'demo1-multi-images.php'     => 'Multi_Images_Widget',
            'demo1-images.php'           => 'Images_Widget',
            'demo1-mission-image.php'    => 'Mission_Images_Widget',
            'demo1-contact-form.php'     => 'Theme_Contact_Form_Widget',
            'demo1-icon-list.php'        => 'Icon_List_Widget',
            'demo1-case-studies.php'     => 'Case_Studies_Widget',
            'demo1-single-case-study.php'=> 'Case_Study_Single_Widget',
        ];

        foreach ( $widgets as $file => $class ) {
            $path = STARBIZ_WIDGETS_PATH . 'widgets/demo1/' . $file;
            if ( file_exists( $path ) ) {
                require_once $path;
                if ( class_exists( $class ) ) {
                    $widgets_manager->register_widget_type( new $class() );
                }
            }
        }
    });

});


/**
 * Enqueue frontend styles & scripts
 */
add_action( 'wp_enqueue_scripts', function() {

    $base_url = get_stylesheet_directory_uri() . '/widgets/assets/';

    // CSS assets
    $css_files = [
        'demo1', //demo1.css
        'montserrat-font', //montserrat-font.css
        'all.min', //all.min.css
        'swiper-bundle.min', //swiper-bundle.min.css
    ];

    foreach ( $css_files as $handle ) {
        wp_enqueue_style( $handle, $base_url . "css/{$handle}.css", [], '1.0.0' );
    }

    // JS assets
    $js_files = [
        'swiper-bundle.min'  => ['jquery'],
        'demo1'     => ['jquery','swiper-bundle.min'],
    ];

    foreach ( $js_files as $handle => $deps ) {
        wp_enqueue_script( $handle, $base_url . "js/{$handle}.js", $deps, '1.0.0', true );
    }

});