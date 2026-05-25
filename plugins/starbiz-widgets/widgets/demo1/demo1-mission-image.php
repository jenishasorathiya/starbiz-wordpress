<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Mission_Images_Widget extends Widget_Base {

    public function get_name() {
        return 'Mission_Image_Widget';
    }

    public function get_title() {
        return __( 'Theme Mission Images', 'starbiz' );
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
				'label' => __( 'Multiple Images', 'starbiz' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'first_image',
            [
                'label'   => __( 'First Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('first'),
                    'url' => starbiz_get_image_url_by_name('first'),
                ],
            ]
        );

        $this->add_control(
            'second_image',
            [
                'label'   => __( 'Second Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('second'),
                    'url' => starbiz_get_image_url_by_name('second'),
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
            <div class="demo1-mission-images">
                <div class="mission-image">
                    <img src="<?php echo esc_url( $settings['first_image']['url'] ); ?>" alt="First" class="first-img">
                    <img src="<?php echo esc_url( $settings['second_image']['url'] ); ?>" alt="second" class="second-img">
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