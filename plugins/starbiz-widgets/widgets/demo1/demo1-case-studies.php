<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Case_Studies_Widget extends Widget_Base {

    public function get_name() {
        return 'case_studies_widget';
    }

    public function get_title() {
        return __( 'Theme Case Studies', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        // ================= Content Section =================
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
                'default' => 4,
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
                    'rand'          => __( 'Random', 'starbiz' ),
                ],
            ]
        );

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
                'name'    => 'thumb',
                'default' => 'large',
            ]
        );

        $this->end_controls_section();

        // ================= Style Section =================
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
                'selector' => '{{WRAPPER}} .case-category',
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => __( 'Category Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-category' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .case-title a',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'starbiz' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'case_studies',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
        ];

        $query = new \WP_Query( $args );

        echo '<div class="demo1-case-studies">';
        if ( $query->have_posts() ) {
            echo '<div class="row case-studies-wrapper">';

            while ( $query->have_posts() ) {
                $query->the_post();

                // Get categories (for 'case_category' taxonomy)
                $terms = get_the_terms( get_the_ID(), 'case_category' );
                $category_name = '';
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    $category_name = $terms[0]->name;
                }

                ?>
                <div class="case-card">
                    <div class="case-study-card">
                        <div class="case-image">
                            <?php 
                                $settings['featured_image'] = [ 'id' => get_post_thumbnail_id() ];
                                $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumb', 'featured_image' );
                                if ( $image_html ) {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">' . $image_html . '</a>';
                                }
                            ?>
                        </div>
                        <div class="case-content">
                            <?php if ( $category_name ) : ?>
                                <p class="case-category"><?php echo esc_html( $category_name ); ?></p>
                            <?php endif; ?>

                            <h5 class="case-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }

            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __( 'No case studies found.', 'starbiz' ) . '</p>';
        }
        echo '</div>';
    }
}
