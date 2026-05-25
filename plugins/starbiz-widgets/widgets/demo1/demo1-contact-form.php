<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Theme_Contact_Form_Widget extends Widget_Base {

    public function get_name() {
        return 'theme_contact_form_widget';
    }

    public function get_title() {
        return __( 'Theme Contact Form', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ]; // Change to your category slug
    }

    protected function register_controls() {

        // ─── Contact Form Section 
        $this->start_controls_section(
            'contact_form_section',
            [
                'label' => __( 'Contact Form', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Fetch Contact Form 7 forms dynamically
        $contact_forms = [];

        if ( class_exists( 'WPCF7' ) ) {
            $forms = get_posts( [
                'post_type'      => 'wpcf7_contact_form',
                'posts_per_page' => -1,
            ] );

            if ( $forms ) {
                foreach ( $forms as $form ) {
                    $contact_forms[ $form->ID ] = $form->post_title;
                }
            }
        }

        if ( empty( $contact_forms ) ) {
            $contact_forms[0] = __( 'No forms found. Please create a Contact Form 7 form first.', 'starbiz' );
        }

        $this->add_control(
            'selected_form',
            [
                'label'   => __( 'Select Contact Form', 'starbiz' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $contact_forms,
                'default' => array_key_first( $contact_forms ),
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label'       => __( 'Form Title', 'starbiz' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Get in Touch', 'starbiz' ),
                'placeholder' => __( 'Enter a title for your form section', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // ─── Style Section 
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'starbiz' ),
                'type'  => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [ 'title' => __( 'Left', 'starbiz' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'starbiz' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'starbiz' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-contact-form' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $form_id  = $settings['selected_form'];

        echo '<div class="theme-contact-form">';

        if ( ! empty( $settings['form_title'] ) ) {
            echo '<h3 class="form-title">' . esc_html( $settings['form_title'] ) . '</h3>';
        }

        if ( class_exists( 'WPCF7' ) && $form_id && $form_id != 0 ) {
            echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' );
        } else {
            echo '<p>' . esc_html__( 'Please select a valid Contact Form 7 form.', 'starbiz' ) . '</p>';
        }

        echo '</div>';
    }
}
