<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Hero_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'Hero_Banner_Widget';
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
                'label'   => __( 'Main Image', 'my-custom-theme' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ) . 'widgets/assets/images/main.png',
                ],
            ]
        );

        $this->add_control(
            'image_bg',
            [
                'label'   => __( 'Background Image', 'my-custom-theme' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ) . 'widgets/assets/images/bg.png',
                ],
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label'   => __( 'Icon Image', 'my-custom-theme' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ) . 'widgets/assets/images/icon.png',
                ],
            ]
        );

        $this->add_control(
            'image_team',
            [
                'label'   => __( 'Team Image', 'my-custom-theme' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ) . 'widgets/assets/images/team.png',
                ],
            ]
        );

        $this->add_control(
            'image_business',
            [
                'label'   => __( 'Business Image', 'my-custom-theme' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ) . 'widgets/assets/images/business.png',
                ],
            ]
        );

        $this->add_control(
            'note_overflow',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => __( '<strong>Tip:</strong> Make sure the parent Section has <code>Overflow: Hidden</code> enabled to prevent layout issues.', 'my-custom-theme' ),
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
                    <img src="<?php echo esc_url( $settings['image_icon']['url'] ); ?>" alt="Icon" class="icon-img">
                    <img src="<?php echo esc_url( $settings['image_team']['url'] ); ?>" alt="Team" class="team-img">
                    <img src="<?php echo esc_url( $settings['image_business']['url'] ); ?>" alt="Business" class="business-img">
                </div>
                
                
            </div>
        <?php
    }
}