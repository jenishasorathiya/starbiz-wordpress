<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Multi_Images_Widget extends Widget_Base {

    public function get_name() {
        return 'Multi_Image_Widget';
    }

    public function get_title() {
        return __( 'Theme Multiple Images', 'starbiz' );
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
            'multi1_image',
            [
                'label'   => __( 'Image 1', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('multi1'),
                    'url' => starbiz_get_image_url_by_name('multi1'),
                ],
            ]
        );

        $this->add_control(
            'multi2_image',
            [
                'label'   => __( 'Image 2', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('multi2'),
                    'url' => starbiz_get_image_url_by_name('multi2'),
                ],
            ]
        );

        $this->add_control(
            'image_round',
            [
                'label'   => __( 'Round Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('round-img'),
                    'url' => starbiz_get_image_url_by_name('round-img'),
                ],
            ]
        );

        $this->add_control(
            'image_dots',
            [
                'label'   => __( 'Dots Image', 'starbiz' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'id'  => starbiz_get_attachment_by_name('dots-img'),
                    'url' => starbiz_get_image_url_by_name('dots-img'),
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
            <div class="demo1-multi-images">
                <div class="multi-image">
                    <div class="relative">
                        <div class="absolute ani-wrap">
                            <div class="img-wrap">
                                <img src="<?php echo esc_url( $settings['multi1_image']['url'] ); ?>" alt="Main" class="multi-main-img absolute">
                            </div>
                        </div>
                    </div>
                    
                    <?php if ( ! empty( $settings['multi2_image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['multi2_image']['url'] ); ?>" alt="second" class="multi-second-img">
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['image_round']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $settings['image_round']['url'] ); ?>" alt="circle" class="round-img">
                    <?php endif; ?>
                    <img src="<?php echo esc_url( $settings['image_dots']['url'] ); ?>" alt="dots" class="dots-img">
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