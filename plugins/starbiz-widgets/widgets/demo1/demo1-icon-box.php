<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Icon_Box_Widget';
    }

    public function get_title() {
        return __( 'Theme Icon Box', 'starbiz' );
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
            'icon',
            [
                'label' => __( 'Icon', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Icon Box Title', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'This is an icon box description.', 'starbiz' ),
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // ─── Style Section 
        $this->start_controls_section(
            'style_box_section',
            [
                'label' => __('Box', 'starbiz'),
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
                '{{WRAPPER}} .demo1-icon-box .icon-content' => 'text-align: {{VALUE}};',
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
                '{{WRAPPER}} .demo1-icon-box' => '{{VALUE}}',
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
            'default' => 'center',
            'selectors_dictionary' => [
                'start'  => 'justify-content: flex-start; align-items: flex-start;',
                'center' => 'justify-content: center; align-items: center;',
                'end'    => 'justify-content: flex-end; align-items: flex-end;',
            ],
            'selectors' => [
                '{{WRAPPER}} .demo1-icon-box' => '{{VALUE}}',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-icon-box',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_box_border',
                'selector' => '{{WRAPPER}} .demo1-icon-box',
            ]
        );

        $this->add_control(
            'icon_box_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-icon-box',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icon', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'icon_color', [
            'label' => __( 'Icon Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-icon-box .icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Icon spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-icon-box' => 'gap: {{SIZE}}{{UNIT}};',
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
                    'px' => [ 'min' => 0, 'max' => 90 ],
                    'em' => [ 'min' => 1, 'max' => 8 ],
                    'rem'=> [ 'min' => 1, 'max' => 7 ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-icon-box .icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
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
                    '{{WRAPPER}} .demo1-icon-box .icon-content' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .demo1-icon-box .icon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .demo1-icon-box .icon-title',
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
                    '{{WRAPPER}} .demo1-icon-box .icon-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .demo1-icon-box .icon-desc',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="demo1-icon-box">
                <?php if ( ! empty( $settings['icon']['value'] ) ) : ?>
                    <div class="icon">
                         <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                <?php endif; ?>                   
            
            <div class="icon-content">
                <?php if ( $settings['title'] ) : ?>
                    <h4 class="icon-title"><?php echo esc_html( $settings['title'] ); ?></h4>
                <?php endif; ?>

                <?php if ( $settings['description'] ) : ?>
                    <p class="icon-desc"><?php echo esc_html( $settings['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}