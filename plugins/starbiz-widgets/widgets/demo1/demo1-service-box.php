<?php
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Service_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Service_Box_Widget';
    }

    public function get_title() {
        return __( 'Theme Service Box', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        // ─── Content Section
        $this->start_controls_section( 'content_section', [
            'label' => __( 'Content', 'starbiz' )
        ]);

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('star'),
                    'url' => starbiz_get_image_url_by_name('star'),
                ],
            ]
        );

        $repeater->add_control(
            'arrow_image',
            [
                'label'   => __( 'Arrow_Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('arrow_link'),
                    'url' => starbiz_get_image_url_by_name('arrow_link'),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Icon Box Title', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'This is an icon box description.', 'starbiz' ),
                'rows' => 3,
            ]
        );

        $repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'starbiz' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'starbiz' ),
			]
		);

        $this->add_control(
            'services_list',
            [
                'label' => __( 'Service Boxes', 'starbiz' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // ─── Style Section 
        $this->start_controls_section(
            'style_headings_section',
            [
                'label' => __('Service Box', 'starbiz'),
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
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .demo1-service-box' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-service-box',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'service_box_border',
                'selector' => '{{WRAPPER}} .demo1-service-box',
            ]
        );

        $this->add_control(
            'service_box_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-service-box',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Image size', 'starbiz' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 600 ],
					'%' => [ 'min' => 5, 'max' => 100 ],
					'vw' => [ 'min' => 5, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .demo1-service-box .service-icons .service-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'arrow_img_width',
			[
				'label' => __( 'Arrow size', 'starbiz' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 80 ],
					'%' => [ 'min' => 5, 'max' => 60 ],
					'vw' => [ 'min' => 5, 'max' => 50 ],
				],
				'selectors' => [
					'{{WRAPPER}} .demo1-service-box .service-icons .arrow-img' => 'width: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before',

			]
		);

        $this->start_controls_tabs( 'service_box_style_tabs' );

        // Normal Tab
        $this->start_controls_tab( 'service_box_normal_tab', [
            'label' => __( 'Normal', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'normal_bg',
                'label'    => __( 'Arrow Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'service_arrow_box_border',
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img',
            ]
        );

        $this->add_control(
            'normal_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box .arrow-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'normal_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-service-box .arrow-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab( 'service_box_hover_tab', [
            'label' => __( 'Hover', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'hover_bg',
                'label'    => __( 'Arrow Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img:hover',
            ]
        );

        $this->add_control(
            'hover_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box .arrow-img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'hover_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-service-box .arrow-img:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-service-box .arrow-img:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label' => __( 'Content spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box .service-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // title Heading
        $this->add_control(
            'title_style_heading',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box .service-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .demo1-service-box .service-title',
            ]
        );

        // Description Heading
        $this->add_control(
            'description_style_heading',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-service-box .service-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .demo1-service-box .service-desc',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $services = $settings['services_list'];

    if ( empty($services) ) return;

    echo '<div class="demo1-service-wrapper"><div class="services-row">';

        foreach ( $services as $index => $item ) {

            $this->add_link_attributes( 'link_' . $index, $item['link'] );
            ?>
            <div class="demo1-service-box">

                <div class="service-icons">
                    <?php if ( ! empty( $item['image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="Main" class="service-img">
                    <?php endif; ?>

                    <?php if ( ! empty( $item['arrow_image']['url'] ) ) : ?>
                        <div class="arrow-container">
                            <a <?php echo $this->get_render_attribute_string( 'link_' . $index ); ?>>
                                <img src="<?php echo esc_url( $item['arrow_image']['url'] ); ?>" alt="arrow" class="arrow-img">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="service-content">
                    <?php if ( ! empty( $item['title'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'link_' . $index ); ?>>
                            <h4 class="service-title"><?php echo esc_html( $item['title'] ); ?></h4>
                        </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $item['description'] ) ) : ?>
                        <p class="service-desc"><?php echo esc_html( $item['description'] ); ?></p>
                    <?php endif; ?>
                </div>
                    <div class="bg-shape">
                    </div>

            </div>
            <?php
        }

        echo '</div></div>';

    }
}