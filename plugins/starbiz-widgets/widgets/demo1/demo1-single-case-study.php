<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit;

class Case_Study_Single_Widget extends Widget_Base {

    public function get_name() {
        return 'case_study_single';
    }

    public function get_title() {
        return __( 'Theme Case Study Single', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {
        // No manual selection — everything is dynamic for the current post
        $this->start_controls_section( 'content_section', [
            'label' => __( 'Content', 'starbiz' )
        ]);

        $this->add_control(
            'note_overflow',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => __( '<strong>Note:</strong> This widget is designed for the <strong>Single Case Studies</strong> post template. Please use it only on Single Post pages for the <code>case_studies</code> custom post type. ', 'starbiz' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Styles', 'starbiz' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Category Style
        $this->add_control(
            'category_heading',
            [
                'label' => __( 'Category', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_typography',
                'selector' => '{{WRAPPER}} .case-single-meta',
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => __( 'Category Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Style
        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Title', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .case-single-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Description Style
        $this->add_control(
            'description_heading',
            [
                'label' => __( 'Description', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .case-single-desc',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Description Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Client Name Style
        $this->add_control(
            'client_heading',
            [
                'label' => __( 'Client', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'client_heading_typography',
                'selector' => '{{WRAPPER}} .case-single-info .case-client h6',
            ]
        );

        $this->add_control(
            'client_heading_color',
            [
                'label'     => __( 'Client Heading Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-info .case-client h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'client_name_typography',
                'selector' => '{{WRAPPER}} .case-single-info .case-client p',
            ]
        );

        $this->add_control(
            'client_name_color',
            [
                'label'     => __( 'Client Name Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-info .case-client p' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Realese date Style
        $this->add_control(
            'date_heading',
            [
                'label' => __( 'Realese Date', 'starbiz' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_heading_typography',
                'selector' => '{{WRAPPER}} .case-single-info .case-date h6',
            ]
        );

        $this->add_control(
            'date_heading_color',
            [
                'label'     => __( 'Date Heading Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-info .case-date h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_name_typography',
                'selector' => '{{WRAPPER}} .case-single-info .case-date p',
            ]
        );

        $this->add_control(
            'date_name_color',
            [
                'label'     => __( 'Date Name Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-single-info .case-date p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        // Automatically get current post ID
        $post_id = get_the_ID();
        if ( ! $post_id ) return;

        $post = get_post( $post_id );
        if ( ! $post ) return;

        // Meta and taxonomy
        $client = get_post_meta( $post_id, '_case_client', true );
        // $desc   = apply_filters( 'the_content', $post->post_content );
        $desc = get_post_meta( $post_id, '_case_desc', true );
        $date   = get_the_date( 'd, F, Y', $post_id );

        $terms = get_the_terms( $post_id, 'case_category' );
        $category = '';
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $category = esc_html( $terms[0]->name );
        }

        $thumbnail = get_the_post_thumbnail_url( $post_id, 'large' );
        ?>

        <div class="demo1-case-single-widget">

            <?php if ( $thumbnail ): ?>
                <div class="case-single-image">
                    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
                </div>
            <?php endif; ?>

            <?php if ( $category ): ?>
                <div class="case-single-meta">
                    <?php echo esc_html( $category ); ?>
                </div>
            <?php endif; ?>

            <h2 class="case-single-title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>

            <div class="case-single-desc"><?php echo $desc; ?></div>

            <div class="case-single-info">
                <?php if ( $client ): ?>
                    <div class="case-client">
                        <h6>Client</h6>
                        <p><?php echo esc_html( $client ); ?></p>
                    </div>
                <?php endif; ?>

                <div class="case-date">
                    <h6>Release Date</h6>
                    <p><?php echo esc_html( $date ); ?></p>
                </div>
            </div>

        </div>

        <?php
    }
}
