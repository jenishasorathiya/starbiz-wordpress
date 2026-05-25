<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class Gallery_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'gallery_slider_widget';
    }

    public function get_title() {
        return __( 'Theme Image carousel', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    public function get_style_depends() {
        return [ 'swiper' ];
    }

    public function get_script_depends() {
        return [ 'swiper' ];
    }

    protected function register_controls() {

        // Gallery images
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Gallery', 'starbiz' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_items',
            [
                'label' => __( 'Choose Images', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label'   => __( 'Images Per View', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __( 'Autoplay', 'starbiz' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'starbiz' ),
                'label_off'    => __( 'No', 'starbiz' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label'     => __( 'Autoplay Delay (ms)', 'starbiz' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 3000,
                'min'       => 1000,
                'step'      => 500,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => __( 'Transition Speed (ms)', 'starbiz' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 600,
                'min'       => 100,
                'step'      => 100,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'Icon_section',
            [
                'label' => __( 'Icons', 'starbiz' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label'        => __( 'Show Arrows', 'starbiz' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'starbiz' ),
                'label_off'    => __( 'No', 'starbiz' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'icon-left',
            [
                'label' => __( 'Icon-Left', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [],
                'recommended' => [
                    'fa-solid' => [ 'arrow-left'],
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon-right',
            [
                'label' => __( 'Icon-Right', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [],
                'recommended' => [
                    'fa-solid' => [ 'arrow-right'],
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

            // Gallery Images Styling
            $this->start_controls_section(
                'gallery_style_section',
                [
                    'label' => __( 'Gallery Images', 'starbiz' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'slides_gap',
                [
                    'label' => __( 'Gap Between Slides', 'starbiz' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 30,
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'size' => 15,
                        'unit' => 'px',
                    ],
                ]
            );

            // $this->add_responsive_control(
            //     'image_border_radius',
            //     [
            //         'label' => __( 'Border Radius', 'starbiz' ),
            //         'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            //         'selectors' => [
            //             '{{WRAPPER}} .demo1-gallery-slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );

            // $this->add_group_control(
            //     \Elementor\Group_Control_Box_Shadow::get_type(),
            //     [
            //         'name'     => 'image_box_shadow',
            //         'selector' => '{{WRAPPER}} .demo1-gallery-slider img',
            //     ]
            // );

            // $this->add_group_control(
            //     \Elementor\Group_Control_Border::get_type(),
            //     [
            //         'name'     => 'image_border',
            //         'selector' => '{{WRAPPER}} .demo1-gallery-slider img',
            //     ]
            // );

            $this->end_controls_section();

            // Arrow Styling
            $this->start_controls_section(
                'arrow_style_section',
                [
                    'label' => __( 'Arrows', 'starbiz' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'arrow_color',
                [
                    'label'     => __( 'Arrow Color', 'starbiz' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .demo1-gallery-widget .icon svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_arrows' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'arrow_background_color',
                [
                    'label'     => __( 'Arrow Background Color', 'starbiz' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .demo1-gallery-widget .icon' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_arrows' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'arrow_size',
                [
                    'label' => __( 'Arrow Size', 'starbiz' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .demo1-gallery-widget .icon svg' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .demo1-gallery-widget .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                    ],
                    'condition' => [
                        'show_arrows' => 'yes',
                    ],
                ]
            );

            $this->end_controls_section();

        }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $has_arrows = ( 'yes' === $settings['show_arrows'] ) ? 'has-arrows' : 'no-arrows';

            ?>

            <div class="demo1-gallery-widget elementor-widget-<?php echo esc_attr($widget_id); ?> <?php echo esc_attr($has_arrows); ?>">
                <div class="swiper demo1-gallery-slider swiper-<?php echo esc_attr($widget_id); ?>">
                    <div class="swiper-wrapper">
                        <?php foreach ( $settings['gallery_items'] as $image ) : ?>
                            <div class="swiper-slide">
                                <div class="partner-logos-image">
                                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ( 'yes' === $settings['show_arrows'] ) : ?>
                    <div class="swiper-button-prev custom-prev-<?php echo esc_attr($widget_id); ?> icon">
                        <?php 
                        if ( ! empty( $settings['icon-left']['value'] ) ) {
                            \Elementor\Icons_Manager::render_icon( $settings['icon-left'], [ 'aria-hidden' => 'true' ] );
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next custom-next-<?php echo esc_attr($widget_id); ?> icon">
                        <?php 
                        if ( ! empty( $settings['icon-right']['value'] ) ) {
                            \Elementor\Icons_Manager::render_icon( $settings['icon-right'], [ 'aria-hidden' => 'true' ] );
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <script>
            jQuery(document).ready(function($){
                new Swiper('.swiper-<?php echo esc_attr($widget_id); ?>', {
                    slidesPerView: <?php echo isset($settings['slides_per_view']) ? intval($settings['slides_per_view']) : 6; ?>,
                    spaceBetween: <?php echo isset($settings['slides_gap']['size']) ? intval($settings['slides_gap']['size']) : 30; ?>,
                    centeredSlides: true,
                    loop: true,
                    watchOverflow: true,
                    grabCursor: true,
                    navigation: {
                        nextEl: '.custom-next-<?php echo esc_attr($widget_id); ?>',
                        prevEl: '.custom-prev-<?php echo esc_attr($widget_id); ?>',
                    },
                    <?php if ( $settings['autoplay'] === 'yes' ) : ?>
                        autoplay: {
                            delay: <?php echo !empty($settings['autoplay_delay']) ? intval($settings['autoplay_delay']) : 3000; ?>,
                            disableOnInteraction: false,
                        },
                        speed: <?php echo !empty($settings['autoplay_speed']) ? intval($settings['autoplay_speed']) : 600; ?>,
                    <?php endif; ?>
                    breakpoints: {
                        // 📱 Mobile Portrait (0–767)
                        0: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_mobile']) ? intval($settings['slides_per_view_mobile']) : 1; ?>
                        },
                        420: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_mobile']) ? intval($settings['slides_per_view_mobile']) : 3; ?>
                        },
                        // 📱 Mobile Landscape (768–880)
                        768: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_mobile_landscape']) ? intval($settings['slides_per_view_mobile_landscape']) : 3; ?>
                        },
                        // 📱 Tablet Portrait (881–1024)
                        881: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_tablet_portrait']) ? intval($settings['slides_per_view_tablet_portrait']) : 4; ?>
                        },
                        // 💻 Tablet Landscape (1025–1200)
                        1025: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_tablet_landscape']) ? intval($settings['slides_per_view_tablet_landscape']) : 5; ?>
                        },
                        // 💻 Laptop (1201–1366)
                        1201: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view_laptop']) ? intval($settings['slides_per_view_laptop']) : 6; ?>
                        },
                        // 🖥️ Desktop (1367+)
                        1367: {
                            slidesPerView: <?php echo !empty($settings['slides_per_view']) ? intval($settings['slides_per_view']) : 6; ?>
                        }
                    }
                });
            });
            </script>
        <?php
    }
}
