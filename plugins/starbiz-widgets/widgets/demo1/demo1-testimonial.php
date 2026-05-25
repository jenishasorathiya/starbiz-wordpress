<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'testimonial_slider';
    }

    public function get_title() {
        return __( 'Theme Testimonial', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function _register_controls() {

        // === CONTENT ===
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Testimonials', 'starbiz' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'quote-image',
            [
                'label' => __( 'Image', 'starbiz' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 
                    'id'  => starbiz_get_attachment_by_name('quote'),
                    'url' => starbiz_get_image_url_by_name('quote'),
                ],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => __( 'Content', 'starbiz' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'GrowthX Solutions helped us develop a clear roadmap for growth. Their strategy has been a game-changer for our business.', 'starbiz' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'starbiz' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 
                    'id'  => starbiz_get_attachment_by_name('frame'),
                    'url' => starbiz_get_image_url_by_name('frame'),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Name', 'starbiz' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Samantha Harris', 'starbiz' ),
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => __( 'Designation', 'starbiz' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'CEO, TechFlow Solutions', 'starbiz' ),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __( 'Testimonials', 'starbiz' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'Samantha Harris',
                        'designation' => 'CEO, TechFlow Solutions',
                    ],
                    [
                        'name' => 'David Lee',
                        'designation' => 'Founder, Artisan Goods',
                    ],
                    [
                        'name' => 'Samantha Harris',
                        'designation' => 'CEO, TechFlow Solutions',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __( 'Slider Settings', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'navigation_type',
            [
                'label' => __( 'Navigation Type', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'dots',
                'options' => [
                    'none'   => __( 'None', 'starbiz' ),
                    'dots'   => __( 'Dots', 'starbiz' ),
                    'arrows' => __( 'Arrows', 'starbiz' ),
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'starbiz' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'starbiz' ),
                'label_off' => __( 'Off', 'starbiz' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label' => __( 'Autoplay Delay (ms)', 'starbiz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
                'min' => 1000,
                'step' => 500,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Transition Speed (ms)', 'starbiz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 100,
                'step' => 100,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // === STYLE ===
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Style', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // title Heading
        $this->add_control(
            'title_style_heading',
            [
                'label' => __( 'Name', 'starbiz' ),
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
                    '{{WRAPPER}} .demo1-testimonial-slider .author-info .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .demo1-testimonial-slider .author-info .name',
            ]
        );

        // Designation Heading
        $this->add_control(
            'designation_style_heading',
            [
                'label' => __( 'Designation', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label' => __( 'Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-testimonial-slider .author-info .designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .demo1-testimonial-slider .author-info .designation',
            ]
        );

        $this->add_control(
            'description_style',
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
                    '{{WRAPPER}} .demo1-testimonial-slider .testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .demo1-testimonial-slider .testimonial-content',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_pagination_section',
            [
                'label' => __('Pagination Style', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pagination_normal_heading',
            [
                'label' => __( 'Normal', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'bullet_color',
                'label'    => __( 'Bullet Color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-testimonial-slider .swiper-pagination-bullet',
                'condition' => [
                    'navigation_type' => 'dots',
                ],
            ]
        );

        // --- Active Heading ---
        $this->add_control(
            'pagination_active_heading',
            [
                'label' => __( 'Active', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'active_bullet_color',
                'label'    => __( 'Active Bullet Color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-testimonial-slider .swiper-pagination-bullet-active',
                'condition' => [
                    'navigation_type' => 'dots',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Arrow Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-testimonial-slider .swiper-button-prev::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .demo1-testimonial-slider .swiper-button-next::after' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_type' => 'arrows',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $autoplay     = ( $settings['autoplay'] === 'yes' ) ? 'true' : 'false';
        $autoplay_delay  = ! empty( $settings['autoplay_delay'] ) ? $settings['autoplay_delay'] : 3000;
        $autoplay_speed  = ! empty( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : 600;
        ?>

        <div class="demo1-testimonial-slider swiper"
            data-autoplay="<?php echo esc_attr( $autoplay ); ?>"
            data-delay="<?php echo esc_attr( $autoplay_delay ); ?>"
            data-speed="<?php echo esc_attr( $autoplay_speed ); ?>"
            data-navigation="<?php echo esc_attr( $settings['navigation_type'] ); ?>"
        >
            <div class="swiper-wrapper">
                <?php foreach ( $settings['testimonials'] as $item ) : ?>
                    <div class="swiper-slide">
                        <div class="demo1-testimonial-card">
                            <div class="quote-icon">
                                <?php if ( ! empty( $item['quote-image']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url( $item['quote-image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
                                <?php endif; ?>
                            </div>
                            <p class="testimonial-content"><?php echo esc_html( $item['content'] ); ?></p>
                            <div class="testimonial-author">
                                <?php if ( ! empty( $item['image']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
                                <?php endif; ?>
                                <div class="author-info">
                                    <h5 class="name"><?php echo esc_html( $item['name'] ); ?></h5>
                                    <span class="designation"><?php echo esc_html( $item['designation'] ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ( 'dots' === $settings['navigation_type'] ) : ?>
                <div class="swiper-pagination"></div>
            <?php elseif ( 'arrows' === $settings['navigation_type'] ) : ?>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            <?php endif; ?>
        </div>

        <?php
    }

    public function get_script_depends() {
        return [ 'swiper', 'demo1' ];
    }

    public function get_style_depends() {
        return [ 'swiper', 'demo1' ];
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
