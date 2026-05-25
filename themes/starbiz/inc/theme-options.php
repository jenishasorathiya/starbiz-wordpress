<?php
if ( ! class_exists('Redux') ) return;

add_action('after_setup_theme', function() {

    // Only initialize Redux in admin
    if ( ! is_admin() ) return;

    $opt_name = 'starbiz_options';

    // Redux configuration
    $args = [
        'opt_name'           => $opt_name,
        'display_name'       => 'StarBiz Options',
        'menu_type'          => 'menu',          // top-level menu
        'allow_sub_menu'     => true,
        'menu_title'         => 'Theme Options',
        'page_title'         => 'Theme Options',
        'menu_slug'          => 'starbiz-options',
        'admin_bar'          => true,
        'dev_mode'           => false,
        'permissions'        => 'manage_options',
        'customizer'         => false,
    ];

    Redux::setArgs( $opt_name, $args );

// global
Redux::setSection( $opt_name, [
    'title'  => 'Global',
    'id'     => 'global',
    'icon'   => 'fa fa-cog',
    'fields' => [
        [
            'id'       => 'back_to_top',
            'type'     => 'switch',
            'title'    => 'Back to Top',
            'default'  => true,
        ],
        [
            'id'       => 'site_favicon',
            'type'     => 'media',
            'title'    => 'Site Favicon',
        ],
    ]
]);

// header
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Header Builder', 'starbiz'),
    'id'    => 'starbiz_header_builder',
    'icon'  => 'fa fa-bars',
    'fields'=> array(
        array(
            'id'    => 'active_header',
            'type'  => 'select',
            'title' => esc_html__('Select Active Header', 'starbiz'),
            'data'  => 'posts',
            'args'  => array(
                'post_type'      => 'starbiz_header',
                'posts_per_page' => -1,
            ),
            'default' => '',
        ),
    ),
));

//footer
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Footer Builder', 'starbiz'),
    'id'    => 'starbiz_footer_builder',
    'icon'  => 'fa fa-toggle-on',
    'fields'=> array(
        array(
            'id'    => 'active_footer',
            'type'  => 'select',
            'title' => esc_html__('Select Active Footer', 'starbiz'),
            'data'  => 'posts',
            'args'  => array(
                'post_type'      => 'starbiz_footer',
                'posts_per_page' => -1,
            ),
            'default' => '',
        ),
    ),
));

// Typography
Redux::setSection( $opt_name, [
    'title'  => 'Typography',
    'id'     => 'typography',
    'icon'   => 'fa fa-font',
    'fields' => [
        [
            'id'       => 'body_font',
            'type'     => 'typography',
            'title'    => 'Body Font',
            'subtitle' => 'Typography for the body text',
            'google'   => true,
            'color'    => false,
            'default'  => [
                'font-size'   => '16px',
                'font-weight' => '500',
                'font-family' => 'Montserrat',
            ],
            'output'   => array( 'body' ), 
        ],
    ]
]);

Redux::setSection( $opt_name, [
    'title'  => 'Colors',
    'id'     => 'colors_section',
    'icon'   => 'fa fa-paint-brush',
    'fields' => [
        [
            'id'    => 'primary_color',
            'type'  => 'color',
            'title' => 'Primary Color',
            'default' => '#262935',
            'output'  => array('body, a'),
        ],
        [
            'id'    => 'secondary_color',
            'type'  => 'color',
            'title' => 'Secondary Color',
            'default' => '#3763EB',
            'output'  => array('.secondary, .btn-secondary'),
        ],
        [
            'id'    => 'text_color',
            'type'  => 'color',
            'title' => 'Text Color',
            'default' => '#3C3E49',
            'output'  => array('body, p, li'),
        ],
        [
            'id'    => 'accent_color',
            'type'  => 'color',
            'title' => 'Accent Color',
            'default' => '#fff',
            'output'  => array('.accent, .highlight'),
        ],
    ],
]);

// Spacing
Redux::setSection( $opt_name, [
    'title'  => 'Spacing',
    'id'     => 'spacing_section',
    'icon'   => 'fa fa-arrows-alt',
    'fields' => [
        [
            'id'       => 'site_padding',
            'type'     => 'spacing',
            'mode'     => 'padding', // only padding
            'units'    => array('px','em','%'),
            'title'    => 'Site Padding',
            'subtitle' => 'Adjust padding for the entire site wrapper',
            'default'  => [
                'padding-top'    => '20px',
                'padding-right'  => '20px',
                'padding-bottom' => '20px',
                'padding-left'   => '20px'
            ],
            'output'   => array('body'), // apply to <body>
        ],
        [
            'id'       => 'site_margin',
            'type'     => 'spacing',
            'mode'     => 'margin', // only margin
            'units'    => array('px','em','%'),
            'title'    => 'Site Margin',
            'subtitle' => 'Adjust margin for the entire site wrapper',
            'default'  => [
                'margin-top'    => '0px',
                'margin-right'  => '0px',
                'margin-bottom' => '0px',
                'margin-left'   => '0px'
            ],
            'output'   => array('body'), // apply to <body>
        ],
    ],
]);

    error_log('Redux initialized in admin');

});
