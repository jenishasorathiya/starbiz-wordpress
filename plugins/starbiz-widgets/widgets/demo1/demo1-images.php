<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Images_Widget extends Widget_Base {

    public function get_name() {
        return 'Image_Widget';
    }

    public function get_title() {
        return __( 'Theme Images', 'starbiz' );
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
				'label' => __( 'Images', 'starbiz' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'service-img1_image',
            [
                'label'   => __( 'Image 1', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('service-img1'),
                    'url' => starbiz_get_image_url_by_name('service-img1'),
                ],
            ]
        );

        $this->add_control(
            'image_dots',
            [
                'label'   => __( 'Dots Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('service-dots'),
                    'url' => starbiz_get_image_url_by_name('service-dots'),
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
            <div class="demo1-single-images">
                <div class="single-image">
                    <div class="relative">
                        <div class="absolute single-image-wrap">
                            <div class="images-wrap">
                                <img src="<?php echo esc_url( $settings['service-img1_image']['url'] ); ?>" alt="Main" class="service-main-img absolute">
                            </div>
                        </div>
                    </div>
                    <img src="<?php echo esc_url( $settings['image_dots']['url'] ); ?>" alt="dots" class="service-dots-img">
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