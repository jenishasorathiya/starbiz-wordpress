<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load TGMPA core classes (including bulk installer)
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';


add_action('tgmpa_register', function () {
    $plugins = [
        [
            'name'     => 'Elementor',
            'slug'     => 'elementor',
            'required' => true,
            'source'   => '',
        ],
        [
            'name'     => 'Redux Framework',
            'slug'     => 'redux-framework',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'StarBiz Widgets', 'starbiz' ),
            'slug'     => 'starbiz-widgets',
            'source'   => get_template_directory() . '/inc/plugins/starbiz-widgets.zip',
            'required' => true,
        ],
        [
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => true,
        ],
        [
            'name'     => 'Elementor Pro',
            'slug'     => 'elementor-pro',
            'source'   => get_template_directory() . '/inc/plugins/elementor-pro.zip',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'StarBiz Demo Importer', 'starbiz' ),
            'slug'     => 'starbiz-demo-importer',
            'source'   => get_template_directory() . '/inc/plugins/starbiz-demo-importer.zip',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'starbiz' ),
            'slug'     => 'one-click-demo-import',
            'required' => true,
        ],
    ];

    $config = [
        'id'           => 'starbiz-theme',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'is_automatic' => false,
    ];

    tgmpa($plugins, $config);
});