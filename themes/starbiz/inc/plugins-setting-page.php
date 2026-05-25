<?php

// Add custom Install Plugins page
add_action('admin_menu', function () {
    add_theme_page(
        'Install Plugins',
        'Install Plugins',
        'manage_options',
        'tgmpa-install-plugins',
        '__return_null'
    );
});

// Display content for the custom page
function custom_install_plugins_page() {
    ?>
    <div class="wrap">
    <div class="container" style="margin-top: 20px;">
        <?php
        if (class_exists('TGM_Plugin_Activation')) {
            $GLOBALS['plugin_page'] = 'tgmpa-install-plugins';
            $tgmpa = call_user_func(['TGM_Plugin_Activation', 'get_instance']);
            $tgmpa->install_plugins_page();
            unset($GLOBALS['plugin_page']);
        } else {
            echo '<p><strong>TGM class not loaded.</strong></p>';
        }
        ?>
    </div>
</div><?php
}

// Show TGMPA notices only on this page
add_filter('tgmpa_show_admin_notice_capability', function ($capability) {
    $screen = get_current_screen();
    return ($screen && $screen->id === 'appearance_page_install-plugins') ? $capability : 'do_not_allow';
});

// Remove default TGMPA submenu under Appearance
add_action('admin_menu', function () {
    remove_submenu_page('themes.php', 'tgmpa-install-plugins');
}, 99);