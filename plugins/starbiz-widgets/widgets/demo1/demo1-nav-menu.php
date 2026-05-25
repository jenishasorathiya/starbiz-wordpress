<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Demo1_Nav_Menu_Widget extends Widget_Base { 

    public function get_name() {
        return 'theme_nav_menu';
    }

    public function get_title() {
        return __('Theme Navigation Menu', 'starbiz');
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return ['demo1-widgets'];
    }

    public function get_style_depends() {
        return ['demo1'];
    }

    public function get_script_depends() {
        return ['demo1'];
    }


    protected function register_controls() {

    $this->start_controls_section(
        'section_layout',
        [
            'label' => esc_html__('Layout', 'starbiz'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    // Menu Name (Just info)
    $locations = get_registered_nav_menus();
        $this->add_control('menu_location', [
            'label' => __('Select Menu', 'starbiz'),
            'type' => Controls_Manager::SELECT,
            'options' => $locations,
            'default' => 'primary',
        ]);

    // Layout: Horizontal or Vertical
    $this->add_control(
        'layout',
        [
            'label' => esc_html__('Layout', 'starbiz'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'horizontal',
            'options' => [
                'horizontal' => esc_html__('Horizontal', 'starbiz'),
                'vertical' => esc_html__('Vertical', 'starbiz'),
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-menu' => 'flex-direction: {{VALUE}};',
            ],
            'prefix_class' => 'layout-',
        ]
    );

    // Alignment
    $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'starbiz'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start'   => ['title' => esc_html__('Start', 'starbiz'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => esc_html__('Center', 'starbiz'), 'icon' => 'eicon-text-align-center'],
                    'flex-end'  => ['title' => esc_html__('End', 'starbiz'), 'icon' => 'eicon-text-align-right'],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .layout-horizontal .custom-menu' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .layout-vertical .custom-menu' => 'align-items: {{VALUE}};',
                ],
            ]
        );

    $this->add_responsive_control(
        'menu_item_spacing',
        [
            'label'     => __( 'Item Spacing', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units'=> [ 'px', 'em', '%' ],
            'range'     => [
                'px' => [ 'min' => 0, 'max' => 100 ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-menu' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    
    $this->add_control(
        'pointer',
        [
            'label'   => esc_html__( 'Pointer', 'starbiz' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none'       => esc_html__( 'None', 'starbiz' ),
                'line'  => esc_html__( 'Line', 'starbiz' ),
                'underline'  => esc_html__( 'Underline', 'starbiz' ),
                'overline'   => esc_html__( 'Overline', 'starbiz' ),
                'double'     => esc_html__( 'Double Line', 'starbiz' ),
                'background' => esc_html__( 'Background', 'starbiz' ),
            ],
            'prefix_class' => 'pointer-',
        ]
    );

    $this->add_control(
        'submenu_indicator',
        [
            'label' => esc_html__('Submenu Indicator', 'starbiz'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chevron-down',
                'library' => 'fa-solid',
            ],
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section('toggle_section', [
            'label' => __('Mobile Toggle', 'starbiz')
        ]);

    $this->add_control(
        'mobile_breakpoint',
        [
            'label'   => __( 'Mobile Dropdown', 'starbiz' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'tablet_portrait',
            'options' => [
                'none'             => __( 'None', 'starbiz' ),
                'mobile_portrait'  => __( 'Mobile Portrait (> 767px)', 'starbiz' ),
                'mobile_landscape' => __( 'Mobile Landscape (> 880px)', 'starbiz' ),
                'tablet_portrait'  => __( 'Tablet Portrait (> 1024px)', 'starbiz' ),
                'tablet_landscape' => __( 'Tablet Landscape (> 1200px)', 'starbiz' ),
            ],
        ]
    );

    $this->add_responsive_control(
        'toggle_align',
        [
            'label' => esc_html__('Toggle Align', 'starbiz'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'starbiz'),
                    'icon' => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'starbiz'),
                    'icon' => 'eicon-h-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'starbiz'),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'selectors' => [
                    '{{WRAPPER}} .custom-menu-toggle' => 'justify-self: {{VALUE}};',
                ],
            'toggle' => false,
            'condition' => [ 'mobile_breakpoint!' => 'none',],
        ]
    );

    $this->start_controls_tabs('toggle_icon_tabs');

    // Normal Tab
    $this->start_controls_tab(
        'toggle_icon_normal',
        [
            'label' => __('Normal', 'starbiz'),
            'condition' => [ 'mobile_breakpoint!' => 'none',],
        ]
    );

    $this->add_control(
        'toggle_icon_normal_icon',
        [
            'label' => esc_html__('Icon', 'starbiz'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-bars',
                'library' => 'fa-solid',
            ],
            'condition' => [ 'mobile_breakpoint!' => 'none',],
        ]
    );

    $this->end_controls_tab();

    // Hover Tab
    $this->start_controls_tab(
        'toggle_icon_hover',
        [
            'label' => __('Hover', 'starbiz'),
            'condition' => [ 'mobile_breakpoint!' => 'none',],
        ]
    );

    $this->add_control(
        'toggle_icon_hover_icon',
        [
            'label' => esc_html__('Hover Icon', 'starbiz'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-bars',
                'library' => 'fa-solid',
            ],
        ]
    );

    $this->end_controls_tab();

    // Active Tab
    $this->start_controls_tab(
        'toggle_icon_active',
        [
            'label' => __('Active', 'starbiz'),
            'condition' => [ 'mobile_breakpoint!' => 'none',],
        ]
    );

    $this->add_control(
        'toggle_icon_active_icon',
        [
            'label' => esc_html__('Active Icon', 'starbiz'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-times',
                'library' => 'fa-solid',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();


    $this->start_controls_section(
        'section_style_menu',
        [
            'label' => __( 'Menu', 'starbiz' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'menu_heading',
        [
            'label' => __( 'Menu', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    // Menu Item Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'menu_typography',
            'label'    => __( 'Typography', 'starbiz' ),
            'selector' => '{{WRAPPER}} .custom-menu a',
        ]
    );

    // Normal / Hover / Active Colors
    $this->start_controls_tabs( 'menu_item_colors' );

    $this->start_controls_tab(
        'menu_item_normal',
        [ 'label' => __( 'Normal', 'starbiz' ) ]
    );
    $this->add_control(
        'menu_item_color',
        [
            'label'     => __( 'Text Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu a' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'menu_item_hover',
        [ 'label' => __( 'Hover', 'starbiz' ) ]
    );
    $this->add_control(
        'menu_item_hover_color',
        [
            'label'     => __( 'Hover Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu a:hover' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'menu_item_active',
        [ 'label' => __( 'Active', 'starbiz' ) ]
    );
    $this->add_control(
        'menu_item_active_color',
        [
            'label'     => __( 'Active Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu .menu-item.current-menu-item a' => 'color: {{VALUE}};',
                '{{WRAPPER}} .custom-menu .menu-item.current_page_item a' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_responsive_control(
        'menu_wrapper_bg_color',
        [
            'label'     => __( 'Background Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu-wrapper' => 'background-color: {{VALUE}};',
            ],
            'separator' => 'before',
        ]
    );


    $this->add_responsive_control(
            'menu_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-menu-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .custom-menu-wrapper',
                'separator' => 'before',
            ]
        );

    $this->add_control(
        'submenu_heading',
        [
            'label' => __( 'Submenu', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'submenu_typography',
            'label'    => __( 'Typography', 'starbiz' ),
            'selector' => '{{WRAPPER}} .sub-menu a',
        ]
    );

    // Normal / Hover / Active Colors
    $this->start_controls_tabs( 'submenu_item_colors' );

    $this->start_controls_tab(
        'submenu_item_normal',
        [ 'label' => __( 'Normal', 'starbiz' ) ]
    );
    $this->add_control(
        'submenu_item_color',
        [
            'label'     => __( 'Text Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sub-menu a' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'submenu_item_hover',
        [ 'label' => __( 'Hover', 'starbiz' ) ]
    );
    $this->add_control(
        'submenu_item_hover_color',
        [
            'label'     => __( 'Hover Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sub-menu a:hover' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_control(
        'submenu_dropdown_heading',
        [
            'label' => __( 'Dropdown', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_control(
        'submenu_indicator_color',
        [
            'label' => esc_html__('Dropdown Color', 'starbiz'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu .menu-item-has-children > a i'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .custom-menu .menu-item-has-children > a svg' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
            'submenu_indicator_size',
            [
                'label'      => __( 'Dropdown Size', 'starbiz' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 30 ],
                    'em' => [ 'min' => 1, 'max' => 8 ],
                    'rem'=> [ 'min' => 1, 'max' => 7 ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .custom-menu .menu-item-has-children svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

    $this->end_controls_section();

    $this->start_controls_section(
        'section_style_toggle',
        [
            'label' => __( 'Toggle Button', 'starbiz' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'mobile_breakpoint!' => 'none',
            ],
        ]
    );

    $this->add_control(
        'toggle_heading_colors',
        [
            'label' => __( 'Colors', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_control(
        'toggle_color',
        [
            'label'     => __( 'Icon Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .custom-menu-toggle svg path' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'toggle_heading_spacing',
        [
            'label' => __( 'Spacing', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_responsive_control(
        'toggle_menu_item_spacing',
        [
            'label'     => __( 'Item Spacing', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'size_units'=> [ 'px', 'em', '%' ],
            'range'     => [
                'px' => [ 'min' => 0, 'max' => 100 ],
            ],
            'selectors' => [
                '{{WRAPPER}} .mobile-menu.active .custom-menu' => 'gap: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .mobile-menu.active .custom-menu .menu-item-has-children .sub-menu' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'toggle_padding',
        [
            'label'      => __( 'Padding', 'starbiz' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .mobile-menu.active .custom-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'toggle_heading_border',
        [
            'label' => __( 'Border', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'toggle_border',
            'selector' => '{{WRAPPER}} .mobile-menu.active .custom-menu',
        ]
    );

    $this->add_responsive_control(
        'toggle_border_radius',
        [
            'label'      => __( 'Border Radius', 'starbiz' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .mobile-menu.active .custom-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->add_control(
        'toggle_heading_shadow',
        [
            'label' => __( 'Shadow', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'toggle_box_shadow',
            'selector' => '{{WRAPPER}} .mobile-menu.active .custom-menu',
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'section_style_breakpoint_menu',
        [
            'label' => __( 'Breakpoint Menu', 'starbiz' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'toggle_menu_color',
        [
            'label'     => __( 'Menu Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .mobile-menu.active .custom-menu li a' => 'color: {{VALUE}};',
                '{{WRAPPER}} .mobile-menu.active .custom-menu .menu-item-has-children .sub-menu li a' => 'color: {{VALUE}};',
            ],
            'separator' => 'before',
        ]
    );

    $this->add_control(
        'toggle_menu_bg_color',
        [
            'label'     => __( 'Menu Background Color', 'starbiz' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .mobile-menu.active .custom-menu' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .mobile-menu.active .custom-menu .menu-item-has-children .sub-menu' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'toggle_menu_border',
            'selector' => '{{WRAPPER}} .mobile-menu.active .custom-menu li',
        ]
    );
    
    $this->end_controls_section();
}


protected function render() {
    $settings = $this->get_settings_for_display();
    $icon = ! empty( $settings['submenu_indicator'] ) ? $settings['submenu_indicator'] : null;
    $layout   = $settings['layout'];
    $pointer  = $settings['pointer'];

    // Breakpoint class
     $mobile_breakpoint = $settings['mobile_breakpoint'] ?? 'tablet_portrait';

    // Define pixel widths for all breakpoints
    $breakpoints = [
        'mobile_portrait'  => 767,
        'mobile_landscape' => 880,
        'tablet_portrait'  => 1024,
        'tablet_landscape' => 1200,
    ];

    // Determine the actual breakpoint width
    $mobile_breakpoint = $settings['mobile_breakpoint'] ?? 'tablet_portrait';
    $breakpoint_width = $breakpoints[$mobile_breakpoint] ?? 1024;

    wp_localize_script(
        'demo1',
        'StarbizMenuSettings',
        [
            'breakpoint' => $breakpoint_width,
        ]
    );
    $unique_id = 'menu-' . $this->get_id();

    // Wrapper
    $this->add_render_attribute( 'wrapper', 'class', [
        'custom-menu-wrapper',
        'layout-' . $layout,
        'pointer-' . $pointer,
    ] );

    echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . ' id="' . esc_attr($unique_id) . '">';

    echo '<div class="custom-menu-toggle" role="button" aria-label="Menu Toggle" tabindex="0">';
                if ( ! empty( $settings['toggle_icon_normal_icon']['value'] ) ) {
                    echo '<span class="menu-toggle-icon normal">';
                    \Elementor\Icons_Manager::render_icon( $settings['toggle_icon_normal_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</span>';
                }

                if ( ! empty( $settings['toggle_icon_hover_icon']['value'] ) ) {
                    echo '<span class="menu-toggle-icon hover" style="display:none;">';
                    \Elementor\Icons_Manager::render_icon( $settings['toggle_icon_hover_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</span>';
                }

                if ( ! empty( $settings['toggle_icon_active_icon']['value'] ) ) {
                    echo '<span class="menu-toggle-icon active" style="display:none;">';
                    \Elementor\Icons_Manager::render_icon( $settings['toggle_icon_active_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</span>';
                }
            echo '</div>';

        echo '<div class="custom-menu-container desktop-menu">';
            wp_nav_menu( [
                'theme_location' => $settings['menu_location'],
                'container'      => false,
                'menu_class'     => 'custom-menu',
                'depth'          => 2,
                'walker'         => new Walker_Nav_Menu_With_Icons( $icon ),
            ] );
        echo '</div>';

        // Always output menu
        echo '<div class="custom-menu-container mobile-menu">';
            wp_nav_menu( [
                'theme_location' => $settings['menu_location'],
                'container'      => false,
                'menu_class'     => 'custom-menu',
                'depth'          => 2,
                'walker'         => new Walker_Nav_Menu_With_Icons( $icon ),
            ] );
        echo '</div>';

    echo '</div>';

    if ( $breakpoint_width && $mobile_breakpoint !== 'none' ) :
        ?>
        <style>
            /* Mobile view - below selected breakpoint */
            @media (max-width: <?php echo esc_attr($breakpoint_width); ?>px) {

            /* Hide desktop menu on mobile */
            #<?php echo esc_attr($unique_id); ?> .desktop-menu {
                display: none !important;
            }

            /* Show toggle button */
            #<?php echo esc_attr($unique_id); ?> .custom-menu-toggle {
                display: block;
                cursor: pointer;
                position: relative;
                z-index: 100000;
                padding: 10px;
                background: none;
                border: none;
            }

            /* Mobile menu container - fixed full screen sliding from right */    
         
            #<?php echo esc_attr($unique_id); ?> .custom-menu-container {
                position: fixed; 
                top: 14%;
                left: -100%;  
                width: 100%;
                height: 86%;
                background: #fff;  
                z-index: 9999; 
                transition: transform 0.3s ease-in-out;  
                opacity: 0;
                pointer-events: none;        
            }

            #<?php echo esc_attr($unique_id); ?> .custom-menu-container.active {
                left: 0;  
            }
           #<?php echo esc_attr($unique_id); ?>  .custom-menu-container {
                transform: translateX(-100%);  
                transition: transform 0.3s ease-in-out;  
            }
    
    
           #<?php echo esc_attr($unique_id); ?> .custom-menu-container.active {
                transform: translateX(0);  
                opacity: 1;
                pointer-events: auto;
                overflow-y:scroll;
                padding:30px 0;
            }

            /* Menu styling */
            #<?php echo esc_attr($unique_id); ?> .custom-menu {
                list-style: none;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            /* Each menu item */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li {
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                padding: 8px;
            }

            /* Menu links */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li a {
                display: block;
                /* color: #3C3E49; */
                text-decoration: none;
                font-size: 16px;
                transition: color 0.3s;
            }

            /* Hover color */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li a:hover {
                color: #3763EB;
            }

            /* Submenu styles */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li.menu-item-has-children > .sub-menu {
                display: none; /* hidden by default */
                list-style: none;
                margin-top: 5px;
                padding-left: 0px; /* Indent submenu */
                position: relative !important;
            }            

            /* Submenu items */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li.menu-item-has-children > .sub-menu li {
                border-bottom: none;
            }

            /* Optional: submenu link styles */
            #<?php echo esc_attr($unique_id); ?> .custom-menu li.menu-item-has-children > .sub-menu li a {
                font-size: 14px;
                padding: 8px;
                color: #3C3E49;
            }

            #<?php echo esc_attr($unique_id); ?> .custom-menu .menu-item-has-children a{
                display:flex;
                justify-content:space-between;
            }

            #<?php echo esc_attr($unique_id); ?> .menu-item-has-children svg{
                fill:#3C3E49;
            }

            #<?php echo esc_attr($unique_id); ?> .menu-item-has-children.open svg{
                transform: scaleY(-1);
            }

            /* Remove hover effect on submenu parent in mobile */
            #<?php echo esc_attr($unique_id); ?>.mobile-menu-mode .custom-menu-container .menu-item-has-children:hover > .sub-menu {
                display: none !important;
            }

            /* Contact us button mobile - hidden */
            #<?php echo esc_attr($unique_id); ?> .contact-us-mobile {
                display: none;
            }


            #<?php echo esc_attr($unique_id); ?> .menu-item-has-children .sub-menu {
                display: none;
                position: relative;
                border-radius: 16px !important;
                border-style: solid;
                border-width: 1px 1px 1px 1px;
                border-color: #E8E8E8;
                background: #f6f6f7 !important;
                margin: 13PX 15px !important;
                transform: translateY(12px);
            }
        }

            /* Desktop overrides */
            @media (min-width: <?php echo esc_attr($breakpoint_width + 1); ?>px) {
                #<?php echo esc_attr($unique_id); ?> .mobile-menu{
                    display: none !important;
                }

                #<?php echo esc_attr($unique_id); ?> .custom-menu-toggle {
                    display: none !important;
                }

                #<?php echo esc_attr($unique_id); ?> .desktop-menu {
                    display: block !important;
                }
            }

        </style>
    <?php
    endif;

    if ( $mobile_breakpoint === 'none' ) : ?>
        <style>
            /* When mobile breakpoint is disabled, hide mobile-specific elements */

            /* Hide mobile menu toggle */
            #<?php echo esc_attr($unique_id); ?> .custom-menu-toggle {
                display: none !important;
            }

            /* Hide mobile menu container */
            #<?php echo esc_attr($unique_id); ?> .custom-menu-container.mobile-menu {
                display: none !important;
            }

            /* Ensure desktop menu always visible */
            #<?php echo esc_attr($unique_id); ?> .desktop-menu {
                display: block !important;
            }
           
        </style>
    <?php endif;
}
 
}

class Walker_Nav_Menu_With_Icons extends Walker_Nav_Menu {
    private $icon;

    public function __construct( $icon ) {
        $this->icon = $icon;
    }

    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        $classes      = empty( $item->classes ) ? [] : (array) $item->classes;
        $class_names  = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $has_children = in_array( 'menu-item-has-children', $classes );

        $output .= '<li class="' . esc_attr( $class_names ) . '">';

        $atts = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $item_output  = '<a'. $attributes .'>';
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );

        if ( $has_children && ! empty( $this->icon ) ) {
            ob_start();
            \Elementor\Icons_Manager::render_icon(
                $this->icon,
                [ 'aria-hidden' => 'true', 'class' => 'submenu-indicator' ]
            );
            $item_output .= ob_get_clean();
        }

        $item_output .= '</a>';
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}