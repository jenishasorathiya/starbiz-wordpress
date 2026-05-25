<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Hero_Headings_Widget extends Widget_Base {

    public function get_name() {
        return 'Hero_Headings_Widget';
    }

    public function get_title() {
        return __( 'Theme Hero Headings', 'starbiz' );
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

        $this->add_control( 'heading_1', [
            'label' => __( 'Subtitle', 'starbiz' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( 'Tailored solutions for business growth', 'starbiz' ),
        ]);

        //heading 
        $this->add_control( 'heading_2_before', [
            'label' => __( 'Before Heading', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Your ', 'starbiz' ),
        ]);

        $this->add_control( 'heading_2', [
            'label' => __( 'Main Heading', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Trusted Partner', 'starbiz' ),
        ]);

        $this->add_control( 'heading_2_after', [
            'label' => __( 'After Heading', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'for Business Growth', 'starbiz' ),
        ]);

        $this->add_control( 'heading_3', [
            'label' => __( 'Description', 'starbiz' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( "At GrowthX Solutions, we specialize in delivering innovative business strategies that drive real results. Whether you're looking to scale operations, enhance your customer experience, or optimize your marketing, we’ve got you covered.", 'starbiz' ),
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

        // Padding
        $this->add_responsive_control( 'padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-hero-headings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_responsive_control( 'alignment_top', [
            'label' => __( 'Text Alignment', 'starbiz' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => __( 'Left', 'starbiz' ), 'icon' => 'eicon-text-align-left' ],
                'center'     => [ 'title' => __( 'Center', 'starbiz' ), 'icon' => 'eicon-text-align-center' ],
                'flex-end'   => [ 'title' => __( 'Right', 'starbiz' ), 'icon' => 'eicon-text-align-right' ],
                ],
            'default' => 'flex-start',
            'selectors' => [
                '{{WRAPPER}} .demo1-hero-headings .hero-top' => 'align-self: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'heading_1_color', [
            'label' => 'Top Heading Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-hero-headings .hero-top' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'subtitle_hover_bg',
                'label'    => __( 'Hover Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-hero-headings .hero-top',
            ]
        );

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'heading_1_typography',
            'label' => __( 'Typography', 'starbiz' ),
            'selector' => '{{WRAPPER}} .demo1-hero-headings .hero-top',
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
                    '{{WRAPPER}} .demo1-hero-headings .hero-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control( 'padding_subtitle', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-hero-headings .hero-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_control(
            'subtitle_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-hero-headings .hero-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .demo1-hero-headings .hero-title' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'heading_2_color', [
            'label' => 'Main Heading',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-hero-headings .hero-heading' => 'color: {{VALUE}}' ],
            'separator' => 'before',
        ]);
        
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading_2_typo',
            'selector' => '{{WRAPPER}} .demo1-hero-headings .hero-heading',
        ]);


        $this->add_control( 'heading_2_after_before_color', [
            'label' => 'Before/After Heading',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-hero-headings .hero-title' => 'color: {{VALUE}}' ],
            'separator' => 'before',
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading_2_after_before_typo',
            'selector' => '{{WRAPPER}} .demo1-hero-headings .hero-title',
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
                    '{{WRAPPER}} .demo1-hero-headings .hero-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control( 'padding_title', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-hero-headings .hero-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // Description
        $this->start_controls_section(
            'style_description_section',
            [
                'label' => __('Description', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control( 'alignment_desc', [
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
                '{{WRAPPER}} .demo1-hero-headings .hero-desc' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'heading_3_color', [
            'label' => 'Description Color',
            'type' => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .demo1-hero-headings .hero-desc' => 'color: {{VALUE}}' ],
        ]);
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'heading_3_typo',
            'selector' => '{{WRAPPER}} .demo1-hero-headings .hero-desc',
        ]);

        $this->add_responsive_control( 'padding_desc', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-hero-headings .hero-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $tag = ! empty( $settings['html_tag'] ) ? $settings['html_tag'] : 'h1';

        echo '<div class="demo1-hero-headings">';
        ?>
            <?php if ( ! empty( $settings['heading_1'] ) ) : ?>
            <?Php
                echo '<div class="hero-top">' . $settings['heading_1'] . '</div>';
            ?>
            <?php endif; ?>
            <?php
            echo "<{$tag} class='hero-title'>" . wp_kses_post($settings['heading_2_before'] . '<span class="hero-heading">' . $settings['heading_2'] . '</span> ' . $settings['heading_2_after']) . "</{$tag}>";
            echo '<div class="hero-desc">' . $settings['heading_3'] . '</div>';
        echo '</div>';
    }
}