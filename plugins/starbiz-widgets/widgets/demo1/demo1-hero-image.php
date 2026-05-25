<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Hero_Image_Widget extends Widget_Base {

    public function get_name() {
        return 'Hero_Image_Widget';
    }

    public function get_title() {
        return __( 'Theme Hero Image', 'starbiz' );
    }

    public function get_icon() {
        return 'custom-star-icon';
    }

    public function get_categories() {
        return [ 'demo1-widgets' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
			'Banner_section',
			[
				'label' => __( 'Hero Banner', 'starbiz' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'image',
            [
                'label'   => __( 'Main Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('main'),
                    'url' => starbiz_get_image_url_by_name('main'),
                ],
            ]
        );

        $this->add_control(
            'image_bg',
            [
                'label'   => __( 'Background Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('bg'),
                    'url' => starbiz_get_image_url_by_name('bg'),
                ],
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label'   => __( 'Icon Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('icon'),
                    'url' => starbiz_get_image_url_by_name('icon'),
                ],
            ]
        );

        $this->add_control(
            'image_team',
            [
                'label'   => __( 'Team Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('team'),
                    'url' => starbiz_get_image_url_by_name('team'),
                ],
            ]
        );

        $this->add_control(
            'image_business',
            [
                'label'   => __( 'Business Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('business'),
                    'url' => starbiz_get_image_url_by_name('business'),
                ],
            ]
        );

        $this->add_control(
            'note_overflow',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => __( '<strong>Tip:</strong> Make sure the parent Section has <code>Overflow: Hidden</code> enabled to prevent layout issues.', 'starbiz' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
            <div class="demo1-hero-banner">
                <div class="image-wrapper">
                    <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="Main" class="main-img">
                    <img src="<?php echo esc_url( $settings['image_bg']['url'] ); ?>" alt="Background" class="bg-img">
                </div>

                <div class="banner-sub-images">
                    <?php if ( ! empty( $settings['image_icon']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['image_icon']['url'] ); ?>" alt="Icon" class="icon-img">
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['image_team']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['image_team']['url'] ); ?>" alt="Team" class="team-img">
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['image_business']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['image_business']['url'] ); ?>" alt="Business" class="business-img">
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