<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

class Subscribe_Form_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'subscribe_form';
    }

    public function get_title() {
        return __( 'Theme Subscribe Form', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ]; 
    }

    protected function register_controls() {

        // Form Section
        $this->start_controls_section(
            'form_section',
            [
                'label' => __( 'Form', 'starbiz' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Input Icon', 'starbiz' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-envelope',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_control(
            'placeholder_text',
            [
                'label' => __( 'Placeholder Text', 'starbiz' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Enter your email address', 'starbiz' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'starbiz' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Subscribe', 'starbiz' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => __( 'Button Icon', 'starbiz' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [ 'arrow-right' ],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
		$this->start_controls_section(
			'input_section_style',
			[
				'label' => __( 'Placeholder Style', 'starbiz' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control( 'input_icon_color', [
            'label' => __( 'Input Icon Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-subscribe .subscribe-mail svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control(
            'input_icon_spacing',
            [
                'label' => __( 'Input Icon spacing', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-mail svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_icon_size',
            [
                'label'      => __( 'Input Icon Size', 'starbiz' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 60 ],
                    'em' => [ 'min' => 1, 'max' => 5 ],
                    'rem'=> [ 'min' => 1, 'max' => 5 ],
                ],
                'default'    => [
                    'size' => 26,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-mail .icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'search_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-mail',
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'search_input_heading',
            [
                'label' => __( 'Search Input', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'placeholder_typography',
                'label'    => __( 'Placeholder Typography', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-mail input',
            ]
        );

        $this->add_control(
            'placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-mail input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_input_padding',
            [
                'label'      => __( 'Padding', 'starbiz' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-mail input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //BUTTON STYLE
        $this->start_controls_section(
            'style_subscribe_button_section',
            [
                'label' => __('Button', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control( 'alignment', [
            'label' => __( 'Button Alignment', 'starbiz' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => __( 'Left', 'starbiz' ), 'icon' => 'eicon-text-align-left' ],
                'center'     => [ 'title' => __( 'Center', 'starbiz' ), 'icon' => 'eicon-text-align-center' ],
                'flex-end'   => [ 'title' => __( 'Right', 'starbiz' ), 'icon' => 'eicon-text-align-right' ],
                ],
            'default' => 'flex-end',
            'selectors' => [
                '{{WRAPPER}} .demo1-subscribe .subscribe-form' => 'align-items: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( 
            \Elementor\Group_Control_Typography::get_type(), 
            [ 
                'name'     => 'subscribe_button_typo', 
                'label'    => __( 'Typography', 'starbiz' ), 
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button', 
                'separator'=> 'before', 
            ] 
        );

        $this->add_responsive_control( 'padding_subscribe_btn', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .demo1-subscribe .subscribe-btn button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button',
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
                    '{{WRAPPER}} .demo1-subscribe .subscribe-btn button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        //Normal Tab
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
                '{{WRAPPER}} .demo1-subscribe .subscribe-btn button .text' => 'color: {{VALUE}};',
                '{{WRAPPER}} .demo1-subscribe .subscribe-btn button .icon svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_bg',
                'label'    => __( 'Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button',
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
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button',
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
                '{{WRAPPER}} .demo1-subscribe .subscribe-btn button:hover .text' => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_hover_bg',
                'label'    => __( 'Hover Background', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'label' => __( 'Hover Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .demo1-subscribe .subscribe-btn button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

         $this->end_controls_section();

        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icon', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'btn_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control( 'icon_color', [
            'label' => __( 'Icon Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-subscribe .subscribe-btn button .icon svg' => 'fill: {{VALUE}};',
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
                'default'    => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-btn button .text' => 'margin-right: {{SIZE}}{{UNIT}};',
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
                    'px' => [ 'min' => 0, 'max' => 60 ],
                    'em' => [ 'min' => 1, 'max' => 5 ],
                    'rem'=> [ 'min' => 1, 'max' => 5 ],
                ],
                'default'    => [
                    'size' => 18,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .demo1-subscribe .subscribe-btn button .icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="demo1-subscribe">
            <form class="subscribe-form" method="post">
                
                    <div class="subscribe-mail">
                        <?php
                        if ( ! empty( $settings['icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                        }
                        ?>
                        <input type="email" 
                            name="email" 
                            placeholder="<?php echo esc_attr( $settings['placeholder_text'] ); ?>" 
                            required>
                    </div>

                    <div class="subscribe-btn">
                        <button type="submit">
                            <?php
                            echo '<span class="btn-overlay"> </span>';
                            echo '<span class="text">' . esc_html( $settings['button_text'] ) . '</span>';
                            echo '<span class="icon">';
                                if ( ! empty( $settings['btn_icon']['value'] ) ) {
                                    \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
                                }
                            echo '</span>';
                            ?>
                        </button>
                    </div>
                
            </form>

            <div class="subscribe-message" style="display:none;"></div>
        </div>

        <script>
        jQuery(function($){
            $('.demo1-subscribe .subscribe-form').on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                var msg = form.next('.subscribe-message');
                msg.text('Thank you for subscribing!').fadeIn();
                form[0].reset();
                setTimeout(function(){ msg.fadeOut(); }, 3000);
            });
        });
        </script>

        <?php
    }
}
