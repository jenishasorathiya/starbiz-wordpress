<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Icon_List_Widget extends Widget_Base {

    public function get_name() {
        return 'Icon_List_Widget';
    }

    public function get_title() {
        return __( 'Theme Icon List', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Title', 'starbiz' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_text',
			[
				'label'   => __( 'Text', 'starbiz' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Digital Marketing & SEO', 'starbiz' ),
			]
		);

		$this->add_control(
			'icon_link',
			[
				'label'       => __( 'Link', 'starbiz' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'starbiz' ),
			]
		);

		$this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [ 'arrow-right'],
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

        // ─── Style Section ───
        $this->start_controls_section(
            'style_iconlist_section',
            [
                'label' => __('Icon List', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control( 'alignment_title', [
            'label' => __( 'Text Alignment', 'starbiz' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'starbiz' ),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'starbiz' ),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __( 'Right', 'starbiz' ),
                    'icon'  => 'eicon-text-align-right',
                ],
                'space-between' => [
                    'title' => __( 'Stretch', 'starbiz' ),
                    'icon'  => 'eicon-h-align-stretch',
                ],
            ],
            'default' => 'space-between',
            'selectors' => [
                '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist' => 'justify-content: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'list_typo',
            'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist-text',
            'separator' => 'before',
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'list_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control( 'padding_list', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'tabs_button_style' );

        // Normal Tab
        $this->start_controls_tab(
            'tab_list_normal',
            [
                'label' => __( 'Normal', 'starbiz' ),
            ]
        );

        $this->add_control( 'list_color', [
            'label' => __( 'Text Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist-text' => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'list_bg',
                'label'    => __( 'Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'tab_list_hover',
            [
                'label' => __( 'Hover', 'starbiz' ),
            ]
        );

        $this->add_control( 'list_hover_color', [
            'label' => __( 'Text Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist:hover .iconlist-text' => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'list_hover_bg',
                'label'    => __( 'Hover Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_box_shadow_hover',
                'label' => __( 'Hover Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icon', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'btn_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Icon spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'default'    => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist-text' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size', 'starbiz' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 60 ],
                    'em' => [ 'min' => 1, 'max' => 5 ],
                    'rem'=> [ 'min' => 1, 'max' => 5 ],
                ],
                'default'    => [
                    'size' => 18,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-iconlist-wrapper .iconlist-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Add link attributes
        if ( ! empty( $settings['icon_link']['url'] ) ) {
            $this->add_link_attributes( 'iconlist_link', $settings['icon_link'] );
        }

        echo '<div class="demo1-iconlist-wrapper">';

            // If link exists, open <a>
            if ( ! empty( $settings['icon_link']['url'] ) ) {
                echo '<a ' . $this->get_render_attribute_string( 'iconlist_link' ) . ' class="iconlist">';
            } else {
                echo '<div class="iconlist">';
            }

                echo '<span class="iconlist-text">' . esc_html( $settings['icon_text'] ) . '</span>';
                
                echo '<div class="iconlist-icon">';
                    if ( ! empty( $settings['icon']['value'] ) ) {
                        \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                    }
                echo '</div>';

            // Close tag
            if ( ! empty( $settings['icon_link']['url'] ) ) {
                echo '</a>';
            } else {
                echo '</div>';
            }

        echo '</div>';
    }

}