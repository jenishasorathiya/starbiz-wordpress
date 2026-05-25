<?php
/**
 * Plugin Name: StarBiz Demo Importer
 * Description: Import prebuilt headers, footers, posts, Elementor-supported widgets, templates, and pages in one click.
 * Version: 1.0.1
 * Author: Rising Star Infotech
 * Author URI: https://risingstarinfotech.com
 * Text Domain: starbiz
 * Tested up to: 6.8.3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/*--------------------------------------------------------------
# Import Files
--------------------------------------------------------------*/
add_filter( 'ocdi/import_files', 'multidemo_import_files' );
function multidemo_import_files() {
    return [
        [
            'import_file_name'             => 'Demo 1',
            'local_import_file'            => plugin_dir_path( __FILE__ ) . 'demo1/content.xml',
            'local_import_customizer_file' => plugin_dir_path( __FILE__ ) . 'demo1/customizer.dat',
            'import_preview_image_url'     => plugin_dir_url( __FILE__ ) . 'demo1/demo1.png',
            'preview_url'                  => '',
        ],
    ];
}

/*--------------------------------------------------------------
# Debug Logger Setup
--------------------------------------------------------------*/
add_action( 'init', function() {
    // Always log to a safe custom file, without redefining WP_DEBUG
    $upload_dir = wp_upload_dir();
    $log_file = trailingslashit( $upload_dir['basedir'] ) . 'importer-debug.log';

    // Create log file if not exists
    if ( ! file_exists( $log_file ) ) {
        file_put_contents( $log_file, "=== StarBiz Importer Debug Log ===\n" );
    }

    // Route PHP warnings/errors and our custom logs here
    ini_set( 'error_log', $log_file );
});

/* Log Import Start and End */
add_action( 'ocdi/before_import', function( $import ) {
    error_log( ">>> [Import Start] " . print_r( $import, true ) );
}, 5 );

add_action( 'ocdi/after_import', function( $import ) {
    error_log( ">>> [Import End] " . print_r( $import, true ) );
}, 999 );

/*--------------------------------------------------------------
# Site Reset Before Import
--------------------------------------------------------------*/
add_action( 'ocdi/before_content_import', 'multidemo_reset_site' );
function multidemo_reset_site( $selected_import ) {
    // 1. Delete all posts (pages, posts, Elementor templates, etc.)
    $all_posts = get_posts([
        'post_type'      => 'any',
        'post_status'    => 'any',
        'numberposts'    => -1,
    ]);
    foreach ( $all_posts as $post ) {
        wp_delete_post( $post->ID, true );
    }

    // 2. Delete all nav menus
    $menus = wp_get_nav_menus();
    foreach ( $menus as $menu ) {
        wp_delete_term( $menu->term_id, 'nav_menu' );
    }

    // 3. Reset theme mods (menus, widgets, customizer settings)
    remove_theme_mods();

    // 4. Delete custom theme header/footer options
    delete_option( 'mytheme_global_header' );
    delete_option( 'mytheme_global_footer' );

    // 5. Clear widgets
    update_option( 'sidebars_widgets', [] );

    // 6. Clear header footer and single post templates
    $to_check = [
        ['header', 'starbiz_header'],
        ['footer', 'starbiz_footer'],
        ['Single Post', 'elementor_library'],
        ['Single Case Study', 'elementor_library'],
    ];

    foreach ($to_check as [$title, $type]) {
        $existing = get_page_by_title($title, OBJECT, $type);
        if ($existing) {
            wp_delete_post($existing->ID, true);
            error_log("🧹 Deleted existing {$title} ({$type}) before import to prevent duplicate.");
        }
    }

    // 7. Clear Elementor cache if plugin exists
    if ( class_exists( '\Elementor\Plugin' ) ) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

    error_log("✅ Site reset before importing: " . $selected_import['import_file_name']);
}

/*--------------------------------------------------------------
# After Import Setup
--------------------------------------------------------------*/
add_action( 'ocdi/after_import', 'multidemo_after_import_setup' );
function multidemo_after_import_setup( $selected_import ) {

    // --- Assign homepage ---
    $homepage = get_page_by_title( 'Home' );
    if ( $homepage ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $homepage->ID );
    }

    // --- Assign Menus ---
    $menu_map = [
        'main'        => 'primary',
        'footer menu' => 'footer',
    ];

    $locations = get_theme_mod( 'nav_menu_locations', [] );
    foreach ( $menu_map as $menu_name => $location_key ) {
        $menu = get_term_by( 'name', $menu_name, 'nav_menu' );
        if ( $menu && ! is_wp_error( $menu ) ) {
            $locations[ $location_key ] = $menu->term_id;
            error_log("✅ Menu assigned: $menu_name → $location_key");

            $items = wp_get_nav_menu_items( $menu->term_id );
            foreach ( $items as $item ) {
                // If URL is empty or invalid, replace with '#'
                if ( empty( $item->url ) || $item->url === get_home_url() ) {
                    wp_update_nav_menu_item( $menu->term_id, $item->ID, [
                        'menu-item-title'     => $item->title,
                        'menu-item-url'       => '#',
                        'menu-item-type'      => 'custom',
                        'menu-item-status'    => 'publish',
                        'menu-item-object'    => '',
                        'menu-item-object-id' => 0,
                    ]);
                    error_log("🔗 Restored valid '#' custom link: {$item->title}");
                }
            }
        } else {
            error_log("⚠️ Menu not found: $menu_name");
        }
    }
    set_theme_mod( 'nav_menu_locations', $locations );

    // --- Assign header & footer ---
    if ( $selected_import['import_file_name'] === 'Demo 1' ) {
        $header = get_page_by_title( 'header', OBJECT, 'starbiz_header' );
        $footer = get_page_by_title( 'footer', OBJECT, 'starbiz_footer' );

        $redux_options = get_option( 'starbiz_options', [] );
        if ( $header ) $redux_options['active_header'] = $header->ID;
        if ( $footer ) $redux_options['active_footer'] = $footer->ID;

        update_option( 'starbiz_options', $redux_options );
        error_log('✅ Header/Footer assigned via Redux options.');
    }

    // --- Regenerate Elementor CSS ---
    if ( class_exists( '\Elementor\Plugin' ) ) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
        if ( method_exists( \Elementor\Plugin::$instance->files_manager, 'regenerate_files' ) ) {
            \Elementor\Plugin::$instance->files_manager->regenerate_files();
        }
    }

    // --- Flush permalinks ---
    flush_rewrite_rules();
    error_log('✅ After import setup complete.');
}


/**
 * Apply Elementor Theme Builder conditions after import.
 * Ensures correct format for Elementor >= 3.17 (array, not serialized string).
 */
function starbiz_apply_elementor_conditions() {
    if ( ! did_action( 'elementor/loaded' ) || ! class_exists( '\ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache' ) ) {
        error_log( '⚠️ Elementor Pro not active — skipping condition setup.' );
        return;
    }

    error_log( '=== [StarBiz] Starting Elementor condition setup ===' );

    // Define templates and their conditions
    $conditions_map = [
        'Single Post'       => [ 'include/singular/post' ],
        'Single Case Study' => [ 'include/singular/case_studies' ],
    ];

    foreach ( $conditions_map as $title => $conditions ) {

        // Find the Elementor library template by title
        $query = new WP_Query( [
            'post_type'      => 'elementor_library',
            'title'          => $title,
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ] );

        if ( ! $query->have_posts() ) {
            error_log( "❌ Template not found: {$title}" );
            continue;
        }

        $template = $query->posts[0];
        $template_id = $template->ID;

        // Save correct meta as array
        update_post_meta( $template_id, '_elementor_conditions', $conditions );

        // Optional: also store human-readable condition name
        update_post_meta( $template_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $template_id, '_elementor_template_type', 'single' );

        error_log( "✅ Applied condition for {$title}: " . implode( ', ', $conditions ) );
    }

    // Regenerate Elementor conditions cache safely
    try {
        $cache = new \ElementorPro\Modules\ThemeBuilder\Classes\Conditions_Cache();
        $cache->regenerate();
        error_log( '✅ Elementor Theme Builder conditions cache rebuilt successfully.' );
    } catch ( Throwable $e ) {
        error_log( '❌ Failed to rebuild Elementor conditions cache: ' . $e->getMessage() );
    }

    error_log( '=== [StarBiz] Elementor condition setup complete ===' );
}
add_action( 'after_setup_theme', 'starbiz_apply_elementor_conditions', 40 );



/**
 * Force Elementor to rebuild Theme Builder display conditions cache
 * after import automatically (final fix)
 */
add_action( 'shutdown', function() {
    if ( ! did_action( 'elementor/loaded' ) || ! class_exists( '\ElementorPro\Modules\ThemeBuilder\Module' ) ) {
        error_log('⚠️ Elementor Pro not active — skipping theme conditions rebuild.');
        return;
    }

    try {
        $theme_builder = \ElementorPro\Modules\ThemeBuilder\Module::instance();

        if ( method_exists( $theme_builder, 'get_conditions_manager' ) ) {
            $conditions_manager = $theme_builder->get_conditions_manager();

            if ( $conditions_manager && method_exists( $conditions_manager, 'get_cache' ) ) {
                $conditions_manager->get_cache()->regenerate();
                error_log('✅ Elementor theme builder cache fully rebuilt (shutdown hook).');
            } else {
                error_log('⚠️ Theme builder cache object missing.');
            }
        } else {
            error_log('⚠️ Theme builder conditions manager unavailable.');
        }
    } catch ( \Throwable $e ) {
        error_log('❌ Failed to rebuild Elementor conditions cache: ' . $e->getMessage());
    }
}, 9999 );




/**
 * ===========================================================
 * ✅ [StarBiz] Final Elementor URL Replacer (Safe + Complete)
 * ===========================================================
 * Automatically replaces old demo URLs in Elementor data
 * after import and regenerates Elementor cache/files.
 */
add_action('ocdi/after_import', function() {

    $old_url = 'https://starbiz.risingstarinfotech.com';
    $new_url = site_url();
    global $wpdb;

    $meta_keys = ['_elementor_data', '_elementor_global_data'];
    $updated = 0;

    foreach ($meta_keys as $meta_key) {
        $rows = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s",
                $meta_key
            )
        );

        foreach ($rows as $row) {
            $data = maybe_unserialize($row->meta_value);
            $modified = false;

            // Decode JSON if it's JSON data
            if (is_string($data) && ($decoded = json_decode($data, true))) {
                $data = $decoded;
            }

            if (is_array($data)) {
                $replaced = starbiz_recursive_search_replace($old_url, $new_url, $data);
                if ($replaced !== $data) {
                    $data = $replaced;
                    $modified = true;
                }
            } elseif (is_string($data) && strpos($data, $old_url) !== false) {
                $data = str_replace($old_url, $new_url, $data);
                $modified = true;
            }

            if ($modified) {
                $final_value = is_array($data) ? wp_json_encode($data) : $data;
                $wpdb->update(
                    $wpdb->postmeta,
                    ['meta_value' => $final_value],
                    ['post_id' => $row->post_id, 'meta_key' => $meta_key]
                );
                $updated++;
            }
        }
    }

    error_log("✅ [StarBiz] Elementor URL Replacer finished — {$updated} records updated.");

    // ✅ Regenerate Elementor CSS & Data
    if (class_exists('\Elementor\Plugin')) {
        try {
            $elementor = \Elementor\Plugin::$instance;
            $elementor->files_manager->clear_cache();

            if (method_exists($elementor->files_manager, 'regenerate_files')) {
                $elementor->files_manager->regenerate_files();
            }

            if (method_exists($elementor->kits_manager, 'rebuild_kits')) {
                $elementor->kits_manager->rebuild_kits();
            }

            error_log('✅ Elementor cache and CSS regenerated successfully.');
        } catch (\Throwable $e) {
            error_log('❌ Elementor regeneration failed: ' . $e->getMessage());
        }
    }

    // ✅ Prevent double-protocol bug on frontend
    add_filter('the_content', 'starbiz_fix_double_protocol', 5);
    add_filter('elementor/frontend/the_content', 'starbiz_fix_double_protocol', 5);
});

/**
 * Recursive array/string search & replace
 */
if (!function_exists('starbiz_recursive_search_replace')) {
    function starbiz_recursive_search_replace($search, $replace, $data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = starbiz_recursive_search_replace($search, $replace, $value);
            }
        } elseif (is_string($data)) {
            $data = str_replace($search, $replace, $data);
        }
        return $data;
    }
}

/**
 * Fix https://http//localhost/ type URLs in frontend
 */
if (!function_exists('starbiz_fix_double_protocol')) {
    function starbiz_fix_double_protocol($content) {
        $site_url = site_url();
        $content = str_replace(
            ['https://http//', 'http://http//', 'https://https//', 'http://https//'],
            $site_url . '/',
            $content
        );
        return $content;
    }
}
