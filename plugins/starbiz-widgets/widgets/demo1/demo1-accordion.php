<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Accordion_Widget extends Widget_Base {

    public function get_name() {
        return 'accordion_widget';
    }

    public function get_title() {
        return __( 'Theme Accordion', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ]; // You can change to your custom category
    }

    protected function register_controls() {

        $this->start_controls_section(
            'accordion_content',
            [
                'label' => __( 'Accordion Items', 'starbiz' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'accordion_title',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Accordion Title', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label' => __( 'Content', 'starbiz' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion content goes here.', 'starbiz' ),
            ]
        );

        $this->add_control(
            'accordion_list',
            [
                'label' => __( 'Accordion Items', 'starbiz' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => __( '1. What type of businesses do you work with?', 'starbiz' ),
                        'accordion_content' => __( 'We partner with startups, small and medium-sized businesses, and growing enterprises across various industries.', 'starbiz' ),
                    ],
                    [
                        'accordion_title' => __( '2.How can your services help my business grow?', 'starbiz' ),
                        'accordion_content' => __( 'Content for accordion item #2.', 'starbiz' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->add_control(
            'expand',
            [
                'label' => __( 'Expand', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-plus',
                    'library' => 'fa-solid',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'collapse',
            [
                'label' => __( 'Collapse', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-minus',
                    'library' => 'fa-solid',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_accordion_section',
            [
                'label' => __('Accordion', 'starbiz'),
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
                'space-between' => [
                    'title' => __( 'Stretch', 'starbiz' ),
                    'icon'  => 'eicon-h-align-stretch',
                ],
            ],
            'default' => 'space-between',
            'selectors' => [
                '{{WRAPPER}} .theme-accordion .accordion-header' => 'justify-content: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __( 'Space Between Items', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label' => __( 'Distance From Content', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-content' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_style_heading',
            [
                'label' => __( 'Icon', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control( 'icon_color', [
            'label' => __( 'Icon Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .theme-accordion .accordion-icon i' => 'color: {{VALUE}};',
            ],
        ] );

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
                    '{{WRAPPER}} .theme-accordion .accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'icon_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ], 
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-icon i',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_header_section',
            [
                'label' => __('Header', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-title',
            ]
        );

        $this->add_control(
            'header_color',
            [
                'label' => __( 'Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'accordion_header_style_tabs' );

        // Normal Tab
        $this->start_controls_tab( 'accordion_normal_header_tab', [
            'label' => __( 'Normal', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'normal_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'faq_box_border',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header',
            ]
        );

        $this->add_control(
            'normal_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'normal_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .theme-accordion .accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab( 'accordion_hover_header_tab', [
            'label' => __( 'Hover', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'hover_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header:hover',
            ]
        );

        $this->add_control(
            'hover_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // active Tab
        $this->start_controls_tab( 'accordion_active_header_tab', [
            'label' => __( 'Active', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'active_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header.active',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'active_border',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header.active',
            ]
        );

        $this->add_control(
            'active_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'active_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-header.active',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'accordion_content_style_tabs' );

        // Normal Tab
        $this->start_controls_tab( 'accordion_normal_content_tab', [
            'label' => __( 'Normal', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'normal_content_bg',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'faq_content_box_border',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content',
            ]
        );

        $this->add_control(
            'normal_content_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control( 'normal_content_padding', [
            'label' => __( 'Padding', 'starbiz' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .theme-accordion .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_content_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab( 'accordion_hover_content_tab', [
            'label' => __( 'Hover', 'starbiz' ),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'hover_bg_content',
                'label'    => __( 'Background color', 'starbiz' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_content_border',
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content:hover',
            ]
        );

        $this->add_control(
            'hover_content_border_radius',
            [
                'label' => __( 'Border Radius', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-accordion .accordion-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_content_box_shadow',
                'label' => __( 'Box Shadow', 'starbiz' ),
                'selector' => '{{WRAPPER}} .theme-accordion .accordion-content:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();

    if ( empty( $settings['accordion_list'] ) ) {
        return;
    }

    $expand_icon   = isset( $settings['expand']['value'] ) ? $settings['expand']['value'] : 'fa fa-plus';
    $collapse_icon = isset( $settings['collapse']['value'] ) ? $settings['collapse']['value'] : 'fa fa-minus';

    ?>

    <div class="theme-accordion" id="themeAccordion-<?php echo esc_attr( $this->get_id() ); ?>">
        <?php foreach ( $settings['accordion_list'] as $index => $item ) : 
            $is_first = $index === 0;
            $item_id  = 'accordion-item-' . $this->get_id() . '-' . $index;
        ?>
            <div class="accordion-item">
                <div class="accordion-header" data-target="#<?php echo esc_attr( $item_id ); ?>">
                    <span class="accordion-title"><?php echo esc_html( $item['accordion_title'] ); ?></span>
                    <span class="accordion-icon">
                        <i class="<?php echo esc_attr( $expand_icon ); ?> expand-icon"></i>
                        <i class="<?php echo esc_attr( $collapse_icon ); ?> collapse-icon"></i>
                    </span>
                </div>
                <div id="<?php echo esc_attr( $item_id ); ?>" class="accordion-content" style="<?php echo $is_first ? '' : 'display:none;'; ?>">
                    <?php echo wp_kses_post( $item['accordion_content'] ); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
(function($){
    $(document).ready(function(){
        var $accordion = $('#themeAccordion-<?php echo esc_js( $this->get_id() ); ?>');

        // ✅ Open the first accordion item by default
        var $firstHeader = $accordion.find('.accordion-header').first();
        var $firstContent = $firstHeader.next('.accordion-content');
        $firstHeader.addClass('active');
        $firstContent.show();

        // Accordion click toggle
        $accordion.find('.accordion-header').on('click', function(){
            var $header = $(this);
            var $content = $header.next('.accordion-content');

            if ($content.is(':visible')) {
                $content.slideUp(200);
                $header.removeClass('active');
            } else {
                $accordion.find('.accordion-content').slideUp(200);
                $accordion.find('.accordion-header').removeClass('active');
                $content.slideDown(200);
                $header.addClass('active');
            }
        });
    });
})(jQuery);
</script>


        <?php
    }
}
