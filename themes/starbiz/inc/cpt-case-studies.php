<?php

// Register Case Studies CPT
add_action('init', 'register_case_studies_post_type');
function register_case_studies_post_type() {

    $labels = [
        'name'               => __('Case Studies', 'starbiz'),
        'singular_name'      => __('Case Study', 'starbiz'),
        'add_new'            => __('Add New Case Study', 'starbiz'),
        'add_new_item'       => __('Add New Case Study', 'starbiz'),
        'edit_item'          => __('Edit Case Study', 'starbiz'),
        'new_item'           => __('New Case Study', 'starbiz'),
        'view_item'          => __('View Case Study', 'starbiz'),
        'search_items'       => __('Search Case Studies', 'starbiz'),
        'not_found'          => __('No Case Studies found', 'starbiz'),
        'not_found_in_trash' => __('No Case Studies found in Trash', 'starbiz'),
        'menu_name'          => __('Case Studies', 'starbiz'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 3,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'elementor'],
        'taxonomies'         => ['case_category'],
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'case-studies'],
        'show_in_rest'       => true,
    ];

    register_post_type('case_studies', $args);
}


// Add Categories to Case Studies
add_action('init', 'register_case_study_taxonomy', 20);
function register_case_study_taxonomy() {

    $labels = [
        'name'              => __('Case Categories', 'starbiz'),
        'singular_name'     => __('Case Category', 'starbiz'),
        'search_items'      => __('Search Case Categories', 'starbiz'),
        'all_items'         => __('All Case Categories', 'starbiz'),
        'parent_item'       => __('Parent Case Category', 'starbiz'),
        'parent_item_colon' => __('Parent Case Category:', 'starbiz'),
        'edit_item'         => __('Edit Case Category', 'starbiz'),
        'update_item'       => __('Update Case Category', 'starbiz'),
        'add_new_item'      => __('Add New Case Category', 'starbiz'),
        'new_item_name'     => __('New Case Category', 'starbiz'),
        'menu_name'         => __('Case Categories', 'starbiz'),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true, // like categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'case-category'],
    ];

    // attach only to "case_studies"
    register_taxonomy('case_category', ['case_studies'], $args);
}



// Add custom meta boxes
add_action('add_meta_boxes', function() {
    add_meta_box(
        'case_studies_custom_fields',
        'Case Studies Details',
        'render_case_studies_meta_box',
        'case_studies',
        'normal',
        'default'
    );
});

// Enable Elementor editor for Case Studies CPT
add_action('elementor/cpt_support', function( $post_types ) {
    $post_types[] = 'case_studies';
    return $post_types;
});

function render_case_studies_meta_box($post) {
    $client = get_post_meta($post->ID, '_case_client', true);
    $case_desc = get_post_meta($post->ID, '_case_desc', true);

    wp_nonce_field('save_case_studies_meta', 'case_studies_nonce');
    ?>
    <div style="margin-top:10px;">
        <p>
            <label><strong>Client Name:</strong></label><br>
            <input type="text" name="case_client" value="<?php echo esc_attr($client); ?>" style="width:100%;">
        </p>
        <p>
            <label><strong>Description:</strong></label><br>
            <textarea name="case_desc" rows="5" style="width:100%;"><?php echo esc_textarea($case_desc); ?></textarea>
        </p>
    </div>
    <?php
}

// -------------------------------
// SAVE META BOX DATA
// -------------------------------
add_action('save_post_case_studies', function($post_id) {
    if (!isset($_POST['case_studies_nonce']) || !wp_verify_nonce($_POST['case_studies_nonce'], 'save_case_studies_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['case_client'])) {
        update_post_meta($post_id, '_case_client', sanitize_text_field($_POST['case_client']));
    }
    if (isset($_POST['case_desc'])) {
        update_post_meta($post_id, '_case_desc', sanitize_text_field($_POST['case_desc']));
    }
});