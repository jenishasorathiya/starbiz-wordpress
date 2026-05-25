<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

class Demo1_Posts_Widget extends Widget_Base {

    public function get_name() {
        return 'demo1_post_widget';
    }

    public function get_title() {
        return __( 'Theme Posts', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        // Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Posts Per Page', 'starbiz' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

         $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'starbiz' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'          => __( 'Date', 'starbiz' ),
                    'title'         => __( 'Title', 'starbiz' ),
                    'ID'            => __( 'ID', 'starbiz' ),
                    'author'        => __( 'Author', 'starbiz' ),
                    'modified'      => __( 'Last Modified', 'starbiz' ),
                    'rand'          => __( 'Random', 'starbiz' ),
                    'comment_count' => __( 'Comment Count', 'starbiz' ),
                ],
            ]
        );

        // Add order control
        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'starbiz' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => __( 'Ascending', 'starbiz' ),
                    'DESC' => __( 'Descending', 'starbiz' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb',
                'default'   => 'large',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'        => __( 'Show Button', 'starbiz' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'starbiz' ),
                'label_off'    => __( 'No', 'starbiz' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label'   => __( 'Text', 'starbiz' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More', 'starbiz' ),
                'condition' => [
                    'show_button' => 'yes',
                ],
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
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Styles', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                '{{WRAPPER}} .post-content' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control(
            'date_heading',
            [
                'label' => __( 'Date', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __( 'Date Typography', 'starbiz' ),
                'selector' => '{{WRAPPER}} .post-date',
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'     => __( 'Date Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-post-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_button_section',
            [
                'label' => __('Button', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'button_typo',
            'selector' => '{{WRAPPER}} .post-button-wrapper a',
            'separator' => 'before',
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .post-button-wrapper .post-btn',
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
                    '{{WRAPPER}} .post-button-wrapper .post-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control( 'padding_btn', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .post-button-wrapper .post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .post-button-wrapper .post-btn .post-btn-text' => 'color: {{VALUE}};',
                '{{WRAPPER}} .post-button-wrapper .post-btn .post-btn-icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_bg',
                'label'    => __( 'Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-button-wrapper .post-btn',
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
                'selector' => '{{WRAPPER}} .post-button-wrapper .post-btn',
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
                '{{WRAPPER}} .post-button-wrapper .post-btn:hover .post-btn-text' => 'color: {{VALUE}};',
                '{{WRAPPER}} .post-button-wrapper .post-btn:hover .post-btn-icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_hover_bg',
                'label'    => __( 'Hover Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-button-wrapper .post-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'label' => __( 'Hover Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .post-button-wrapper .post-btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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
                    '{{WRAPPER}} .post-button-wrapper .post-btn .post-btn-text' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
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
                    '{{WRAPPER}} .post-button-wrapper .post-btn .post-btn-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
        ];

        $query = new \WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<div class="row demo1-post-wrapper g-4">';
            while ( $query->have_posts() ) {
                $query->the_post();

                ?>
                <div class="col-md-4">
                    <div class="demo1-post-card">
                        <div class="post-image">
                            <?php 
                                $settings['featured_image'] = [ 'id' => get_post_thumbnail_id() ]; // Simulate Media control
                                $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumb', 'featured_image' );

                                if ( ! empty( $image_html ) ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo $image_html; ?>
                                    </a>
                            <?php endif; ?>
                        </div>
                        <div class="post-content">
                            
                            <span class="post-date"><?php echo get_the_date('M j, Y'); ?></span>

                            <h3 class="demo1-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <?php

                            echo '<div class="post-button-wrapper">';
                            ?>
                            <a href="<?php the_permalink(); ?>" class="post-btn"> 
                            <?php
                                echo '<span class="post-btn-overlay"> </span>';
                                echo '<span class="post-btn-text">' . esc_html( $settings['btn_text'] ) . '</span>';
                                echo '<span class="post-btn-icon">';

                                    if ( ! empty( $settings['btn_icon']['value'] ) ) {
                                        // Render selected icon
                                        \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
                                    }

                                echo '</span>';
                            ?>
                            </a>
                            <?php
                            echo '</div>';
                            
                            ?>

                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        }
    }
}
