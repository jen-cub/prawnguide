<?php

function base_taxonomies() {

	$labels = array(
		'name'                       => _x( 'States', 'taxonomy general name' ),
		'singular_name'              => _x( 'State', 'taxonomy singular name' ),
		'search_items'               => __( 'Search states' ),
		'popular_items'              => __( 'Popular states' ),
		'all_items'                  => __( 'All states' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Rating' ),
		'update_item'                => __( 'Update Rating' ),
		'add_new_item'               => __( 'Add New Rating' ),
		'new_item_name'              => __( 'New State' ),
		'separate_items_with_commas' => __( 'Separate states with commas' ),
		'add_or_remove_items'        => __( 'Add or remove states' ),
		'choose_from_most_used'      => __( 'Choose from the most used states' ),
		'not_found'                  => __( 'No states found.' ),
		'menu_name'                  => __( 'Ratings' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'state' ),
	);

	register_taxonomy( 'state', 'provider', $args );

}
add_action( 'init', 'base_taxonomies' );
