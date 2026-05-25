<?php
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class fancy_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Fancy_Box_Widget';
    }

    public function get_title() {
        return __( 'Theme Fancy Box', 'starbiz' );
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

        $this->add_control(
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

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Fancy Box Title', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'This is an fancy box description.', 'starbiz' ),
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // ─── Style Section 
        $this->start_controls_section(
            'style_headings_section',
            [
                'label' => __('Fancy Box', 'starbiz'),
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
                '{{WRAPPER}} .demo1-fancy-box' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control( 'icon_position', [
            'label' => __( 'Icon Position', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'top' => [
                    'title' => __( 'Top', 'starbiz' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'left' => [
                    'title' => __( 'Left', 'starbiz' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'right' => [
                    'title' => __( 'Right', 'starbiz' ),
                    'icon'  => 'eicon-h-align-right',
                ],
                'bottom' => [
                    'title' => __( 'Bottom', 'starbiz' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'top',
            'selectors_dictionary' => [
                'top'    => 'flex-direction: column;',
                'bottom' => 'flex-direction: column-reverse;',
                'left'   => 'flex-direction: row;',
                'right'  => 'flex-direction: row-reverse;',
            ],
            'selectors' => [
                '{{WRAPPER}} .demo1-fancy-box' => '{{VALUE}}',
            ],
        ]);

        $this->add_responsive_control( 'icon_alignment', [
            'label' => __( 'Icon Alignment', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => __( 'Start', 'starbiz' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'starbiz' ),
                    'icon'  => 'eicon-h-align-center',
                ],
                'end' => [
                    'title' => __( 'End', 'starbiz' ),
                    'icon'  => 'eicon-h-align-right',
                ],
            ],
            'default' => 'start',
            'selectors_dictionary' => [
                'start'  => 'justify-content: flex-start; align-items: start;',
                'center' => 'justify-content: center; align-items: center;',
                'end'    => 'justify-content: flex-end; align-items: end;',
            ],
            'selectors' => [
                '{{WRAPPER}} .demo1-fancy-box' => '{{VALUE}}',
            ],
        ] );

        $this->start_controls_tabs( 'fancy_box_style_tabs' );

        // Normal Tab
        $this->start_controls_tab( 'fancy_box_normal_tab', [
            'label' => __( 'Normal', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'normal_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-fancy-box',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'fancy_box_border',
                'selector' => '{{WRAPPER}} .demo1-fancy-box',
            ]
        );

        $this->add_control(
            'normal_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-fancy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'normal_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-fancy-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-fancy-box',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab( 'fancy_box_hover_tab', [
            'label' => __( 'Hover', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'hover_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-fancy-box:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'selector' => '{{WRAPPER}} .demo1-fancy-box:hover',
            ]
        );

        $this->add_control(
            'hover_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-fancy-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'hover_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-fancy-box:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-fancy-box:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         $this->add_responsive_control(
            'image_spacing',
            [
                'label' => __( 'Image spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-fancy-box' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Image size', 'starbiz' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%' => [ 'min' => 5, 'max' => 50 ],
					'vw' => [ 'min' => 5, 'max' => 40 ],
				],
				'selectors' => [
					'{{WRAPPER}} .demo1-fancy-box .fancy-box-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);   

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
                    '{{WRAPPER}} .demo1-fancy-box .fancy-content' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .demo1-fancy-box .fancy-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .demo1-fancy-box .fancy-title',
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
                    '{{WRAPPER}} .demo1-fancy-box .fancy-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .demo1-fancy-box .fancy-desc',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        ?>
        <div class="demo1-fancy-box">
            <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                <div class="fancy-box-img">
                    <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                </div>
            <?php endif; ?>                  
            
            <div class="fancy-content">
                <?php if ( $settings['title'] ) : ?>
                    <h4 class="fancy-title"><?php echo esc_html( $settings['title'] ); ?></h4>
                <?php endif; ?>

                <?php if ( $settings['description'] ) : ?>
                    <p class="fancy-desc"><?php echo esc_html( $settings['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'starbiz_get_attachment_by_name' ) ) {
    function starbiz_get_attachment_by_name( $name ) {
        $posts = get_posts([
            'post_type'      => 'attachment',
            'meta_key'       => '_starbiz_image_name',
            'meta_value'     => $name,
            'posts_per_page' => 1,
        ]);
        return $posts ? $posts[0]->ID : false;
    }
}

if ( ! function_exists( 'starbiz_get_image_url_by_name' ) ) {
    function starbiz_get_image_url_by_name( $name ) {
        $id = starbiz_get_attachment_by_name( $name );
        return $id ? wp_get_attachment_url( $id ) : '';
    }
}