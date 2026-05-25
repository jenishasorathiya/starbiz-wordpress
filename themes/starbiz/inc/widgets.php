<?php
/**
 * Widget areas
 *
 * @package starbiz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function starbiz_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'starbiz' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'starbiz' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'starbiz_theme_widgets_init' );
