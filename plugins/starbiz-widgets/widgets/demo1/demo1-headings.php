<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Headings_Widget extends Widget_Base {

    public function get_name() {
        return 'Headings_Widget';
    }

    public function get_title() {
        return __( 'Theme Headings', 'starbiz' );
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

        $this->add_control( 'heading_style', [
            'label' => __( 'Select Style', 'starbiz' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
                'style1' => __( 'Style 1', 'starbiz' ),
                'style2' => __( 'Style 2', 'starbiz' ),
            ],
        ]);

        $this->add_control( 'heading_1', [
            'label' => __( 'Subtitle', 'starbiz' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( 'Our Services', 'starbiz' ),
        ]);

        $this->add_control( 'heading_2', [
            'label' => __( 'Main Heading', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Services That Drive Results', 'starbiz' ),
        ]);

        $this->add_control( 'heading_3', [
            'label' => __( 'Description', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( "GrowthX Solutions offers a range of services designed to meet the unique needs of small and medium-sized businesses. Our expert team works with you to craft strategies that accelerate growth and streamline operations.", 'starbiz' ),
        ]);

        $this->add_control(
            'html_tag',
            [
                'label' => __('HTML Tag', 'starbiz'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'DIV',
                    'p'   => 'P',
                ],
            ]
        );

        $this->end_controls_section();

        // ─── Style Section ───
        $this->start_controls_section(
            'style_headings_section',
            [
                'label' => __('Style', 'starbiz'),
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
                '{{WRAPPER}} .demo1-headings' => 'text-align: {{VALUE}};',
            ],
        ]);

        // Padding
        $this->add_responsive_control( 'padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-headings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // Top Heading
        $this->start_controls_section(
            'style_top_section',
            [
                'label' => __('Subtitle', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading1_style1_color', [
            'label' => 'Subtitle Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-top-style1' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style1',],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'heading1_style1_typography',
            'label' => __( 'Typography', 'starbiz' ),
            'selector' => '{{WRAPPER}} .demo1-headings .hero-top-style1',
            'condition' => [ 'heading_style' => 'style1',],
        ]);

        $this->add_control( 'heading1_style2_color', [
            'label' => 'Subtitle Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-top-style2' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style2',],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'heading1_style2_typography',
            'label' => __( 'Typography', 'starbiz' ),
            'selector' => '{{WRAPPER}} .demo1-headings .hero-top-style2',
            'condition' => [ 'heading_style' => 'style2',],
        ]);

        $this->add_responsive_control(
            'Top',
            [
                'label' => __( 'Spacing Bottom', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-headings .hero-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Main Heading
        $this->start_controls_section(
            'style_main_section',
            [
                'label' => __('Main Heading', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading2_style1_color', [
            'label' => 'Main Heading',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-heading-style1' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style1',],
        ]);
        
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading2_style1_typo',
            'selector' => '{{WRAPPER}} .demo1-headings .hero-heading-style1',
            'condition' => [ 'heading_style' => 'style1',],
        ]);

        $this->add_control( 'heading2_style2_color', [
            'label' => 'Main Heading',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-heading-style2' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style2',],
        ]);
        
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading2_style2_typo',
            'selector' => '{{WRAPPER}} .demo1-headings .hero-heading-style2',
            'condition' => [ 'heading_style' => 'style2',],
        ]);

        $this->add_responsive_control(
            'Main',
            [
                'label' => __( 'Spacing Bottom', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-headings .hero-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Description
        $this->start_controls_section(
            'style_description_section',
            [
                'label' => __('Description', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading3_style1_color', [
            'label' => 'Description Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-desc-style1' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style1',],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading3_style1_typo',
            'selector' => '{{WRAPPER}} .demo1-headings .hero-desc-style1',
            'condition' => [ 'heading_style' => 'style1',],
        ]);

        $this->add_control( 'heading3_style2_color', [
            'label' => 'Description Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-headings .hero-desc-style2' => 'color: {{VALUE}}' ],
            'condition' => [ 'heading_style' => 'style2',],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading3_style2_typo',
            'selector' => '{{WRAPPER}} .demo1-headings .hero-desc-style2',
            'condition' => [ 'heading_style' => 'style2',],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $tag = ! empty( $settings['html_tag'] ) ? $settings['html_tag'] : 'h2';
        $style = ! empty( $settings['heading_style'] ) ? $settings['heading_style'] : 'style1';

        echo '<div class="demo1-headings ' . esc_attr($style) . '">';

        // ─── STYLE 1 ─────────────────────────────
        if ( $style === 'style1' ) {
            echo '<div class="hero-top hero-top-style1">' . esc_html( $settings['heading_1'] ) . '</div>';
            echo "<{$tag} class='hero-heading hero-heading-style1'>" . wp_kses_post( $settings['heading_2'] ) . "</{$tag}>";
            echo '<div class="hero-desc hero-desc-style1">' . wp_kses_post( $settings['heading_3'] ) . '</div>';
        }

        // ─── STYLE 2 ─────────────────────────────
        elseif ( $style === 'style2' ) {
            echo '<div class="hero-top hero-top-style2">' . esc_html( $settings['heading_1'] ) . '</div>';
            echo "<{$tag} class='hero-heading hero-heading-style2'>" . wp_kses_post( $settings['heading_2'] ) . "</{$tag}>";
            echo '<div class="hero-desc hero-desc-style2">' . wp_kses_post( $settings['heading_3'] ) . '</div>';
        }

        echo '</div>';
    }
}