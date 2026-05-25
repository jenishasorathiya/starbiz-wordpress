<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Image_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Image_Box_Widget';
    }

    public function get_title() {
        return __( 'Theme Image Box', 'starbiz' );
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
                'default' => __( 'Title', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Description.', 'starbiz' ),
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
                '{{WRAPPER}} .demo1-image-box .image-content' => 'text-align: {{VALUE}};',
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
                '{{WRAPPER}} .demo1-image-box' => '{{VALUE}}',
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
                '{{WRAPPER}} .demo1-image-box' => '{{VALUE}}',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-image-box',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_box_border',
                'selector' => '{{WRAPPER}} .demo1-image-box',
            ]
        );

        $this->add_control(
            'image_box_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-image-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-image-box',
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
            'image_spacing',
            [
                'label' => __( 'Image spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-image-box' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __( 'Image Size', 'starbiz' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 60 ],
                    'em' => [ 'min' => 1, 'max' => 8 ],
                    'rem'=> [ 'min' => 1, 'max' => 7 ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-image-box img' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
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
                    '{{WRAPPER}} .demo1-image-box .image-content' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .demo1-image-box .image-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .demo1-image-box .image-title',
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
                    '{{WRAPPER}} .demo1-image-box .image-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .demo1-image-box .image-desc',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="demo1-image-box">
            <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                <div class="image-box-img">
                    <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="Main">
                </div>
            <?php endif; ?>                  
            
            <div class="image-content">
                <?php if ( $settings['title'] ) : ?>
                    <h6 class="image-title"><?php echo esc_html( $settings['title'] ); ?></h6>
                <?php endif; ?>

                <?php if ( $settings['description'] ) : ?>
                    <p class="image-desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
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