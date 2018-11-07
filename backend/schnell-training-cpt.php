<?php
/*
* This document has the functionality to create the structures that holds
* the plugin information for Training as Cutsom Post Types
*/



// CUSTOM POST TYPE LOCATIONS
if ( ! function_exists('schnell_training_location') ) {

    // Register Custom Post Type
    function schnell_training_location() {

        $labels = array(
            'name'                  => _x( 'Training Locations', 'Post Type General Name', 'schnell' ),
            'singular_name'         => _x( 'Training Location', 'Post Type Singular Name', 'schnell' ),
            'menu_name'             => __( 'Training Locations', 'schnell' ),
            'name_admin_bar'        => __( 'Training Location', 'schnell' ),
            'archives'              => __( 'Item Archives', 'schnell' ),
            'attributes'            => __( 'Item Attributes', 'schnell' ),
            'parent_item_colon'     => __( 'Parent Item:', 'schnell' ),
            'all_items'             => __( 'Training Locations', 'schnell' ),
            'add_new_item'          => __( 'Add New Item', 'schnell' ),
            'add_new'               => __( 'Add New', 'schnell' ),
            'new_item'              => __( 'New Item', 'schnell' ),
            'edit_item'             => __( 'Edit Item', 'schnell' ),
            'update_item'           => __( 'Update Item', 'schnell' ),
            'view_item'             => __( 'View Item', 'schnell' ),
            'view_items'            => __( 'View Items', 'schnell' ),
            'search_items'          => __( 'Search Item', 'schnell' ),
            'not_found'             => __( 'Not found', 'schnell' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'schnell' ),
            'featured_image'        => __( 'Featured Image', 'schnell' ),
            'set_featured_image'    => __( 'Set featured image', 'schnell' ),
            'remove_featured_image' => __( 'Remove featured image', 'schnell' ),
            'use_featured_image'    => __( 'Use as featured image', 'schnell' ),
            'insert_into_item'      => __( 'Insert into item', 'schnell' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'schnell' ),
            'items_list'            => __( 'Items list', 'schnell' ),
            'items_list_navigation' => __( 'Items list navigation', 'schnell' ),
            'filter_items_list'     => __( 'Filter items list', 'schnell' ),
        );
        $rewrite = array(
            'slug'                  => 'schnellbugel-training-location',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Training Location', 'schnell' ),
            'description'           => __( 'These are the training locations', 'schnell' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=schtra_training',
            'menu_position'         => 100,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'schnellbugel-training-locations',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
        );
        register_post_type( 'schtra_location', $args );

    }
    add_action( 'init', 'schnell_training_location', 0 );

}

// CUSTOM POST TYPE EXPERTS
if ( ! function_exists('schnell_training_expert') ) {

    // Register Custom Post Type
    function schnell_training_expert() {

        $labels = array(
            'name'                  => _x( 'Training Experts', 'Post Type General Name', 'schnell' ),
            'singular_name'         => _x( 'Training Expert', 'Post Type Singular Name', 'schnell' ),
            'menu_name'             => __( 'Training Experts', 'schnell' ),
            'name_admin_bar'        => __( 'Training Expert', 'schnell' ),
            'archives'              => __( 'Item Archives', 'schnell' ),
            'attributes'            => __( 'Item Attributes', 'schnell' ),
            'parent_item_colon'     => __( 'Parent Item:', 'schnell' ),
            'all_items'             => __( 'Training Experts', 'schnell' ),
            'add_new_item'          => __( 'Add New Item', 'schnell' ),
            'add_new'               => __( 'Add New', 'schnell' ),
            'new_item'              => __( 'New Item', 'schnell' ),
            'edit_item'             => __( 'Edit Item', 'schnell' ),
            'update_item'           => __( 'Update Item', 'schnell' ),
            'view_item'             => __( 'View Item', 'schnell' ),
            'view_items'            => __( 'View Items', 'schnell' ),
            'search_items'          => __( 'Search Item', 'schnell' ),
            'not_found'             => __( 'Not found', 'schnell' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'schnell' ),
            'featured_image'        => __( 'Featured Image', 'schnell' ),
            'set_featured_image'    => __( 'Set featured image', 'schnell' ),
            'remove_featured_image' => __( 'Remove featured image', 'schnell' ),
            'use_featured_image'    => __( 'Use as featured image', 'schnell' ),
            'insert_into_item'      => __( 'Insert into item', 'schnell' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'schnell' ),
            'items_list'            => __( 'Items list', 'schnell' ),
            'items_list_navigation' => __( 'Items list navigation', 'schnell' ),
            'filter_items_list'     => __( 'Filter items list', 'schnell' ),
        );
        $rewrite = array(
            'slug'                  => 'schnellbugel-training-expert',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Training Expert', 'schnell' ),
            'description'           => __( 'These are the training experts', 'schnell' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=schtra_training',
            'menu_position'         => 100,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'schnellbugel-training-experts',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
        );
        register_post_type( 'schtra_expert', $args );

    }
    add_action( 'init', 'schnell_training_expert', 0 );

}

// CUSTOM POST TYPE MODULES
if ( ! function_exists('schnell_training_module') ) {

    // Register Custom Post Type
    function schnell_training_module() {

        $labels = array(
            'name'                  => _x( 'Training Modules', 'Post Type General Name', 'schnell' ),
            'singular_name'         => _x( 'Training Module', 'Post Type Singular Name', 'schnell' ),
            'menu_name'             => __( 'Training Modules', 'schnell' ),
            'name_admin_bar'        => __( 'Training Module', 'schnell' ),
            'archives'              => __( 'Item Archives', 'schnell' ),
            'attributes'            => __( 'Item Attributes', 'schnell' ),
            'parent_item_colon'     => __( 'Parent Item:', 'schnell' ),
            'all_items'             => __( 'Training Modules', 'schnell' ),
            'add_new_item'          => __( 'Add New Item', 'schnell' ),
            'add_new'               => __( 'Add New', 'schnell' ),
            'new_item'              => __( 'New Item', 'schnell' ),
            'edit_item'             => __( 'Edit Item', 'schnell' ),
            'update_item'           => __( 'Update Item', 'schnell' ),
            'view_item'             => __( 'View Item', 'schnell' ),
            'view_items'            => __( 'View Items', 'schnell' ),
            'search_items'          => __( 'Search Item', 'schnell' ),
            'not_found'             => __( 'Not found', 'schnell' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'schnell' ),
            'featured_image'        => __( 'Featured Image', 'schnell' ),
            'set_featured_image'    => __( 'Set featured image', 'schnell' ),
            'remove_featured_image' => __( 'Remove featured image', 'schnell' ),
            'use_featured_image'    => __( 'Use as featured image', 'schnell' ),
            'insert_into_item'      => __( 'Insert into item', 'schnell' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'schnell' ),
            'items_list'            => __( 'Items list', 'schnell' ),
            'items_list_navigation' => __( 'Items list navigation', 'schnell' ),
            'filter_items_list'     => __( 'Filter items list', 'schnell' ),
        );
        $rewrite = array(
            'slug'                  => 'schnellbugel-training-module',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Training Module', 'schnell' ),
            'description'           => __( 'These are the training modules', 'schnell' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=schtra_training',
            'menu_position'         => 100,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'schnellbugel-training-modules',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post'
        );
        register_post_type( 'schtra_module', $args );

    }
    add_action( 'init', 'schnell_training_module', 0 );

}

// CUSTOM POST TYPE TRAINING EVENTS
if ( ! function_exists('schnell_training_events') ) {

    // Register Custom Post Type
    function schnell_training_events() {

        $labels = array(
            'name'                  => _x( 'Training Events', 'Post Type General Name', 'schnell' ),
            'singular_name'         => _x( 'Training Event', 'Post Type Singular Name', 'schnell' ),
            'menu_name'             => __( 'Training Events', 'schnell' ),
            'name_admin_bar'        => __( 'Training Event', 'schnell' ),
            'archives'              => __( 'Item Archives', 'schnell' ),
            'attributes'            => __( 'Item Attributes', 'schnell' ),
            'parent_item_colon'     => __( 'Parent Item:', 'schnell' ),
            'all_items'             => __( 'Training Events', 'schnell' ),
            'add_new_item'          => __( 'Add New Item', 'schnell' ),
            'add_new'               => __( 'Add New', 'schnell' ),
            'new_item'              => __( 'New Item', 'schnell' ),
            'edit_item'             => __( 'Edit Item', 'schnell' ),
            'update_item'           => __( 'Update Item', 'schnell' ),
            'view_item'             => __( 'View Item', 'schnell' ),
            'view_items'            => __( 'View Items', 'schnell' ),
            'search_items'          => __( 'Search Item', 'schnell' ),
            'not_found'             => __( 'Not found', 'schnell' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'schnell' ),
            'featured_image'        => __( 'Featured Image', 'schnell' ),
            'set_featured_image'    => __( 'Set featured image', 'schnell' ),
            'remove_featured_image' => __( 'Remove featured image', 'schnell' ),
            'use_featured_image'    => __( 'Use as featured image', 'schnell' ),
            'insert_into_item'      => __( 'Insert into item', 'schnell' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'schnell' ),
            'items_list'            => __( 'Items list', 'schnell' ),
            'items_list_navigation' => __( 'Items list navigation', 'schnell' ),
            'filter_items_list'     => __( 'Filter items list', 'schnell' ),
        );
        $rewrite = array(
            'slug'                  => 'schnellbugel-training-event',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Training Events', 'schnell' ),
            'description'           => __( 'These are the training Events', 'schnell' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=schtra_training',
            'menu_position'         => 100,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'schnellbugel-training-events',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'schtra-events',
        );
        register_post_type( 'schtra_events', $args );

    }
    add_action( 'init', 'schnell_training_events', 0 );

}

// CUSTOM POST TYPE TRAINING
if ( ! function_exists('schnell_training') ) {

    // Register Custom Post Type
    function schnell_training() {

        $labels = array(
            'name'                  => _x( 'Schnellbugel Trainings', 'Post Type General Name', 'schnell' ),
            'singular_name'         => _x( 'Training', 'Post Type Singular Name', 'schnell' ),
            'menu_name'             => __( 'Training', 'schnell' ),
            'name_admin_bar'        => __( 'Training', 'schnell' ),
            'archives'              => __( 'Item Archives', 'schnell' ),
            'attributes'            => __( 'Item Attributes', 'schnell' ),
            'parent_item_colon'     => __( 'Parent Item:', 'schnell' ),
            'all_items'             => __( 'All Trainings', 'schnell' ),
            'add_new_item'          => __( 'Add New Item', 'schnell' ),
            'add_new'               => __( 'Add New Training', 'schnell' ),
            'new_item'              => __( 'New Item', 'schnell' ),
            'edit_item'             => __( 'Edit Item', 'schnell' ),
            'update_item'           => __( 'Update Item', 'schnell' ),
            'view_item'             => __( 'View Item', 'schnell' ),
            'view_items'            => __( 'View Items', 'schnell' ),
            'search_items'          => __( 'Search Item', 'schnell' ),
            'not_found'             => __( 'Not found', 'schnell' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'schnell' ),
            'featured_image'        => __( 'Featured Image', 'schnell' ),
            'set_featured_image'    => __( 'Set featured image', 'schnell' ),
            'remove_featured_image' => __( 'Remove featured image', 'schnell' ),
            'use_featured_image'    => __( 'Use as featured image', 'schnell' ),
            'insert_into_item'      => __( 'Insert into item', 'schnell' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'schnell' ),
            'items_list'            => __( 'Items list', 'schnell' ),
            'items_list_navigation' => __( 'Items list navigation', 'schnell' ),
            'filter_items_list'     => __( 'Filter items list', 'schnell' ),
        );
        $rewrite = array(
            'slug'                  => 'schnellbugel-training',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Training', 'schnell' ),
            'description'           => __( 'These are the trainings', 'schnell' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 2,
            'menu_icon'             => SCHNELL_PLUGIN_URI . '/backend/images/favicon-future.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'schnellbugel-trainings',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'schtra_training', $args );

    }
    add_action( 'init', 'schnell_training', 0 );

}

add_action( 'rest_api_init', 'create_event_post_meta_on_api' ); //

function create_event_post_meta_on_api() {
	register_rest_field( 'schtra_events',
						  'schtra_events_meta_fields',
						  array(
						  	'get_callback' => 'callback_read_events_meta_fields'
							)
						);
}

function callback_read_events_meta_fields( $object ) {
	$post_id = $object['id'];
	return get_post_meta( $post_id );
}

