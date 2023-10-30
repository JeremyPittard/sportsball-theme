
<?php
// Register Yearbook Custom Post Type
function custom_post_type_yearbooks()
{

    $labels = array(
        'name'                  => 'Yearbooks',
        'singular_name'         => 'Yearbook',
        'menu_name'             => 'Yearbooks',
        'name_admin_bar'        => 'Yearbooks',
        'archives'              => 'Yearbook Archives',
        'attributes'            => 'Yearbook Attributes',
        'parent_item_colon'     => 'Parent Yearbook:',
        'all_items'             => 'All Yearbooks',
        'add_new_item'          => 'Add New Yearbook',
        'add_new'               => 'Add New Yearbook',
        'new_item'              => 'New Yearbook',
        'edit_item'             => 'Edit Yearbook',
        'update_item'           => 'Update Yearbook',
        'view_item'             => 'View Yearbook',
        'view_items'            => 'View Yearbooks',
        'search_items'          => 'Search Yearbook',
        'not_found'             => 'Yearbook Not found',
        'not_found_in_trash'    => 'Yearbook Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into Yearbook',
        'uploaded_to_this_item' => 'Uploaded to this Yearbook',
        'items_list'            => 'Yearbooks list',
        'items_list_navigation' => 'Yearbooks list navigation',
        'filter_items_list'     => 'Filter Yearbooks list',
    );
    $args = array(
        'label'                 => 'Yearbook',
        'description'           => 'Club Yearbooks',
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'                => 'dashicons-book-alt'
    );
    register_post_type('yearbooks', $args);
}
add_action('init', 'custom_post_type_yearbooks', 0);
?>