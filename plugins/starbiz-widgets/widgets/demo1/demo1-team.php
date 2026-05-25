<?php
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Team_Widget extends Widget_Base {

    public function get_name() {
        return 'Team_Widget';
    }

    public function get_title() {
        return __( 'Theme Team', 'starbiz' );
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

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('person'),
                    'url' => starbiz_get_image_url_by_name('person'),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Name', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'John Doe', 'starbiz' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'link',
			[
				'label'       => __( 'Profile Link', 'starbiz' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'starbiz' ),
			]
		);

        $repeater->add_control(
            'designation',
            [
                'label' => __( 'designation', 'starbiz' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Founder & CEO', 'starbiz' ),
            ]
        );

        $this->add_control(
            'team_list',
            [
                'label' => __( 'Team Members', 'starbiz' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => 'John Doe',
                        'designation' => 'Founder & CEO',
                    ],
                    [
                        'name' => 'Mark Taylor',
                        'designation' => 'Operations Manager',
                    ],
                    [
                        'name' => 'Jane Smith',
                        'designation' => 'Marketing Director',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_icon_section',
            [
                'label' => __( 'Social Icons', 'starbiz' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater->add_control(
            'icon_link',
            [
                'label' => __( 'Link', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'starbiz' ),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                ],
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'label' => __( 'Social Icons', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => [ 'value' => 'fab fa-facebook', 'library' => 'fa-brands' ],
                        'link' => [ 'url' => 'https://facebook.com', 'is_external' => true ],
                    ],
                    [
                        'icon' => [ 'value' => 'fab fa-x-twitter', 'library' => 'fa-brands' ],
                        'link' => [ 'url' => 'https://twitter.com', 'is_external' => true ],
                    ],
                    [
                        'icon' => [ 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ],
                        'link' => [ 'url' => 'https://in.linkedin.com', 'is_external' => true ],
                    ],
                    [
                        'icon' => [ 'value' => 'fab fa-instagram', 'library' => 'fa-brands' ],
                        'link' => [ 'url' => 'https://www.instagram.com', 'is_external' => true ],
                    ],
                ],
                'title_field' => '{{{ icon.title }}}',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __( 'Shape', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'rounded' => __( 'Rounded', 'starbiz' ),
                    'square' => __( 'Square', 'starbiz' ),
                    'circle' => __( 'Circle', 'starbiz' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'starbiz' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'starbiz' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'starbiz' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .starbiz-social-icons' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ─── Style Section 
        $this->start_controls_section(
            'style_headings_section',
            [
                'label' => __('Style', 'starbiz'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_style_heading',
            [
                'label' => __( 'Name', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .demo1-team-card .team-name',
            ]
        );

        // Description Heading
        $this->add_control(
            'designation_style_heading',
            [
                'label' => __( 'Designation', 'starbiz' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .demo1-team-card .team-des',
            ]
        );

        $this->add_control( 'icon_color', [
            'label' => __( 'Icon Color', 'starbiz' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .demo1-team-card .social-icon svg' => 'fill: {{VALUE}};',
            ],
            'separator' => 'before',
        ] );

    $this->start_controls_tabs( 'team_card_style_tabs' );

    // Normal tab
    $this->start_controls_tab(
        'team_card_normal_tab',
        [
            'label' => __( 'Normal', 'starbiz' ),
        ]
    );

    $this->add_control(
        'name_color',
        [
            'label' => __( 'Name Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card .team-name' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'designation_color',
        [
            'label' => __( 'Designation Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card .team-des' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'background_color',
        [
            'label' => __( 'Background Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card .team-content' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    // Hover tab
    $this->start_controls_tab(
        'team_card_hover_tab',
        [
            'label' => __( 'Hover', 'starbiz' ),
        ]
    );

    $this->add_control(
        'hover_name_color',
        [
            'label' => __( 'Name Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card:hover .team-name:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'hover_designation_color',
        [
            'label' => __( 'Designation Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card:hover .team-des:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'hover_background_color',
        [
            'label' => __( 'Background Color', 'starbiz' ),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .demo1-team-card:hover .team-content:hover' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

$this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $members = $settings['team_list'];

    if ( empty($members) ) return;

    if ( empty( $settings['social_icons'] ) ) 
    {
        return;
    }

    echo '<div class="demo1-team-wrapper"><div class="team-row">';

        foreach ( $members as $index => $item ) {

            $this->add_link_attributes( 'link_' . $index, $item['link'] );
            ?>
            <div class="demo1-team-card">
                <div class="team-image-box">
                    <?php if ( ! empty( $item['image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="person" class="person-img">
                    <?php endif; ?>

                    <div class="starbiz-social-icons">
                        <?php foreach ( $settings['social_icons'] as $icon_item ) :
                            $icon = $icon_item['icon'];
                            $link = $icon_item['icon_link'];
                            $target = $link['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <div class="icon-bg shape-<?php echo esc_attr($settings['shape']); ?>">
                            <a href="<?php echo esc_url($link['url']); ?>" class="social-icon" <?php echo $target . $nofollow; ?>>
                                <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="team-content">
                        <?php if ( ! empty( $item['name'] ) ) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'link_' . $index ); ?>>
                                <h4 class="team-name"><?php echo esc_html( $item['name'] ); ?></h4>
                            </a>
                        <?php endif; ?>

                        <?php if ( ! empty( $item['designation'] ) ) : ?>
                            <p class="team-des"><?php echo esc_html( $item['designation'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>               

            </div>
            <?php
        }

        echo '</div></div>';

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