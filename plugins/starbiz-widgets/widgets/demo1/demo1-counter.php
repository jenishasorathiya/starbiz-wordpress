<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Counter_Widget extends Widget_Base {

    public function get_name() {
        return 'counter_widget';
    }

    public function get_title() {
        return __('Theme Counter', 'starbiz');
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return ['demo1-widgets'];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'starbiz'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __( 'Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('counter'),
                    'url' => starbiz_get_image_url_by_name('counter'),
                ],
            ]
        );

        $this->add_control('number', [
            'label' => __('Number', 'starbiz'),
            'type' => Controls_Manager::NUMBER,
            'default' => 100,
        ]);

        $this->add_control('prefix', [
            'label' => __('Prefix', 'starbiz'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
        ]);

        $this->add_control('suffix', [
            'label' => __('Suffix', 'starbiz'),
            'type' => Controls_Manager::TEXT,
            'default' => '+',
        ]);

        $this->add_control('title', [
            'label' => __('Title', 'starbiz'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Title', 'starbiz'),
        ]);

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'starbiz'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                '{{WRAPPER}} .demo1-counter-widget .demo1-counter-inner' => 'text-align: {{VALUE}};',
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
            'default' => 'left',
            'selectors_dictionary' => [
                'top'    => 'flex-direction: column;',
                'bottom' => 'flex-direction: column-reverse;',
                'left'   => 'flex-direction: row;',
                'right'  => 'flex-direction: row-reverse;',
            ],
            'selectors' => [
                '{{WRAPPER}} .demo1-counter-widget' => '{{VALUE}}',
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
                'start'  => 'justify-content: flex-start;',
                'center' => 'justify-content: center; align-items: center;',
                'end'    => 'justify-content: flex-end;',
            ],
            'selectors' => [
                '{{WRAPPER}} .demo1-counter-widget' => '{{VALUE}}',
            ],
        ] );

        $this->add_responsive_control(
            'image_spacing',
            [
                'label' => __( 'Image spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-counter-widget' => 'gap: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .demo1-counter-widget .demo1-counter-inner' => 'gap: {{SIZE}}{{UNIT}};',
                ],
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
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%' => [ 'min' => 5, 'max' => 60 ],
					'vw' => [ 'min' => 5, 'max' => 30 ],
				],
				'selectors' => [
					'{{WRAPPER}} .demo1-counter-widget .counter-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'counter_image_style_tabs' );

        // Normal Tab
        $this->start_controls_tab( 'counter_image_normal_tab', [
            'label' => __( 'Normal', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'normal_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'counter_box_border',
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img',
            ]
        );

        $this->add_control(
            'normal_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-counter-widget .counter-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'normal_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-counter-widget .counter-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab( 'counter_image_hover_tab', [
            'label' => __( 'Hover', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'hover_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img:hover',
            ]
        );

        $this->add_control(
            'hover_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-counter-widget .counter-img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'hover_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-counter-widget .counter-img:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-counter-widget .counter-img:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Number Style
        $this->start_controls_section(
            'style_number', [
                'label' => __('Number', 'starbiz'), 
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'number_color', [
                'label' => __('Color', 'starbiz'), 
                'type' => Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .demo1-counter-value' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .demo1-counter-prefix' => 'color: {{VALUE}};',    
                    '{{WRAPPER}} .demo1-counter-suffix' => 'color: {{VALUE}};',         
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'selector' => '{{WRAPPER}} .demo1-counter-value, {{WRAPPER}} .demo1-counter-prefix, {{WRAPPER}} .demo1-counter-suffix',
            ]
        );


        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'style_title', [
                'label' => __('Title', 'starbiz'), 
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => __('Color', 'starbiz'), 
                'type' => Controls_Manager::COLOR, 
                'selectors' => ['{{WRAPPER}} .demo1-counter-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'title_typography', 
            'selector' => '{{WRAPPER}} .demo1-counter-title'
        ]);
        
        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="demo1-counter-widget">
            <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                <div class="counter-img">
                    <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                </div>
            <?php endif; ?>

            <div class="demo1-counter-inner">
                <div class="demo1-counter-number" data-count="<?php echo esc_attr($settings['number']); ?>">
                    <span class="demo1-counter-prefix"><?php echo esc_html($settings['prefix']); ?></span>
                    <span class="demo1-counter-value">0</span>
                    <span class="demo1-counter-suffix"><?php echo esc_html($settings['suffix']); ?></span>
                </div>
                <div class="demo1-counter-title"><?php echo esc_html($settings['title']); ?></div>
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