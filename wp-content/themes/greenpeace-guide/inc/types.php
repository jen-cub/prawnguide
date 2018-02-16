<?php

function base_types() {

    // Providers
    // -------------------

    $labels = array(
        'name'               => 'Provider',
        'singular_name'      => 'Provider',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Provider',
        'edit_item'          => 'Edit Provider',
        'new_item'           => 'New Provider',
        'all_items'          => 'All Provider',
        'view_item'          => 'View Provider',
        'search_items'       => 'Search Provider',
        'not_found'          => 'No providers found',
        'not_found_in_trash' => 'No providers found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Providers'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'provider' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 10,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'provider', $args );

}
add_action( 'init', 'base_types' );
