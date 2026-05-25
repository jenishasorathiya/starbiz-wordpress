<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
$favicon = starbiz_get_option('site_favicon');

if ( ! empty( $favicon ) && ! empty( $favicon['url'] ) ) {
    echo '<link rel="icon" href="' . esc_url( $favicon['url'] ) . '" type="image/x-icon" />';
}else {
    // Prevent browser from requesting default /favicon.ico
    echo '<link rel="icon" href="data:," />';
}
?>

<?php wp_head(); ?>
</head>
<body <?php body_class('starbiz-site-body'); ?>>
<?php wp_body_open(); ?>

<div class="site-content">

<?php
if ( class_exists( 'Redux' ) ){
$active_header_id = Redux::get_Option('starbiz_options', 'active_header', false);

if ($active_header_id && class_exists('Elementor\Plugin')) {
    echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_header_id);
} else {
    ?>
    <header class="site-header bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" 
                        alt="<?php bloginfo('name'); ?>" height="30">
                    <?php
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryMenu" aria-controls="primaryMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="primaryMenu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'container'      => false,
                    'walker'       => new WP_Bootstrap_Navwalker(),
                ]);
                ?>
            </div>
        </nav>
    </div>
</header>
    <?php
}
}
else {
    ?>
    <header class="site-header bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
             <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" 
                        alt="<?php bloginfo('name'); ?>" height="30">
                    <?php
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryMenu" aria-controls="primaryMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="primaryMenu">
                <?php
                if ( has_nav_menu('primary') ) {
                    // Display the assigned menu
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        'container'      => false,
                        'walker'         => new WP_Bootstrap_Navwalker(),
                    ]);
                } else {
                    $pages = get_pages(['post_status' => 'publish']);

                    if ( !empty($pages) ) {
                        // List all published pages
                        echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
                        echo '<li class="nav-item"><a class="nav-link" href="' . home_url() . '">Home</a></li>';

                        foreach ( $pages as $page ) {
                            echo '<li class="nav-item"><a class="nav-link" href="' . get_permalink($page->ID) . '">' . esc_html($page->post_title) . '</a></li>';
                        }

                        echo '</ul>';
                    } else {
                        // No pages exist → show a default hardcoded menu
                        echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item"><a class="nav-link" href="' . home_url() . '">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="' . home_url('/about') . '">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="' . home_url('/contact') . '">Contact</a></li>
                            </ul>';
                    }
                }
                ?>
            </div>
        </nav>
    </div>
</header>
    <?php
}
?>

