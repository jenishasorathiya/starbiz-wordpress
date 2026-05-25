<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Button_Widget extends Widget_Base {

    public function get_name() {
        return 'Button_Widget';
    }

    public function get_title() {
        return __( 'Theme Button', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'starbiz' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'   => __( 'Text', 'starbiz' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Get In Touch', 'starbiz' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => __( 'Link', 'starbiz' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'starbiz' ),
			]
		);

		$this->add_control(
            'btn_icon',
            [
                'label' => __( 'Icon', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
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
            'style_button_section',
            [
                'label' => __('Button', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control( 'alignment', [
            'label' => __( 'Button Alignment', 'starbiz' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => __( 'Left', 'starbiz' ), 'icon' => 'eicon-text-align-left' ],
                'center'     => [ 'title' => __( 'Center', 'starbiz' ), 'icon' => 'eicon-text-align-center' ],
                'flex-end'   => [ 'title' => __( 'Right', 'starbiz' ), 'icon' => 'eicon-text-align-right' ],
                ],
            'default' => 'flex-start',
            'selectors' => [
                '{{WRAPPER}} .demo1-button-wrapper' => 'justify-self: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'button_typo',
            'selector' => '{{WRAPPER}} .demo1-button-wrapper a',
            'separator' => 'before',
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .demo1-button-wrapper .starbiz-button',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-button-wrapper .starbiz-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control( 'padding_btn', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-button-wrapper .starbiz-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'tabs_button_style' );

        // Normal Tab
        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'starbiz' ),
            ]
        );

        $this->add_control( 'button_color', [
            'label' => __( 'Text Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-button-wrapper .starbiz-button .text' => 'color: {{VALUE}};',
                '{{WRAPPER}} .demo1-button-wrapper .starbiz-button .icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_bg',
                'label'    => __( 'Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-button-wrapper .starbiz-button',
                'fields_options' => [
                    // Set default type to classic (solid color)
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#3763EB', // default solid color
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-button-wrapper .starbiz-button',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'starbiz' ),
            ]
        );

        $this->add_control( 'button_hover_color', [
            'label' => __( 'Text Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-button-wrapper .starbiz-button:hover .text' => 'color: {{VALUE}};',
                '{{WRAPPER}} .demo1-button-wrapper .starbiz-button:hover .icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_hover_bg',
                'label'    => __( 'Hover Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-button-wrapper .starbiz-button:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'label' => __( 'Hover Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-button-wrapper .starbiz-button:hover',
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
                    '{{WRAPPER}} .demo1-button-wrapper .starbiz-button .text' => 'margin-right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .demo1-button-wrapper .starbiz-button .icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'button', 'class', 'starbiz-button' );
		if (! empty( $settings['btn_link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', esc_url( $settings['btn_link']['url'] ) );
			if ( $settings['btn_link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}
			if ( $settings['btn_link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

        echo '<div class="demo1-button-wrapper">';
        echo '<a ' . $this->get_render_attribute_string( 'button' ) . '>';
            echo '<span class="btn-overlay"> </span>';
            echo '<span class="text">' . esc_html( $settings['btn_text'] ) . '</span>';
            echo '<span class="icon">';

                if ( isset( $settings['btn_icon']['value'] ) && ! empty( $settings['btn_icon']['value'] ) ) {
                    \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
                }


            echo '</span>';
        echo '</a>';
        echo '</div>';
    }
}