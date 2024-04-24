<?php
/**
 * Registers the Portfolio Tag Taxonomy used for the Portfolio Item Custom Post Type
 */
function create_pawsome_tag_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Tags', 'Taxonomy General Name', 'pawsome-portfolio' ),
		'singular_name'              => _x( 'Portfolio Tag', 'Taxonomy Singular Name', 'pawsome-portfolio' ),
		'menu_name'                  => __( 'Portfolio Tag', 'pawsome-portfolio' ),
		'all_items'                  => __( 'All Portfolio Tags', 'pawsome-portfolio' ),
		'parent_item'                => __( 'Parent Portfolio Tag', 'pawsome-portfolio' ),
		'parent_item_colon'          => __( 'Parent Portfolio Tag:', 'pawsome-portfolio' ),
		'new_item_name'              => __( 'New Portfolio Tag Name', 'pawsome-portfolio' ),
		'add_new_item'               => __( 'Add New Portfolio Tag', 'pawsome-portfolio' ),
		'edit_item'                  => __( 'Edit Portfolio Tag', 'pawsome-portfolio' ),
		'update_item'                => __( 'Update Portfolio Tag', 'pawsome-portfolio' ),
		'view_item'                  => __( 'View Portfolio Tag', 'pawsome-portfolio' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Tags with commas', 'pawsome-portfolio' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Tags', 'pawsome-portfolio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'pawsome-portfolio' ),
		'popular_items'              => __( 'Popular Portfolio Tags', 'pawsome-portfolio' ),
		'search_items'               => __( 'Search Portfolio Tags', 'pawsome-portfolio' ),
		'not_found'                  => __( 'Not Found', 'pawsome-portfolio' ),
		'no_terms'                   => __( 'No Portfolio Tags', 'pawsome-portfolio' ),
		'items_list'                 => __( 'Portfolio Tags list', 'pawsome-portfolio' ),
		'items_list_navigation'      => __( 'Portfolio Tags list navigation', 'pawsome-portfolio' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'portfolio-tag' ),
	);
	register_taxonomy( 'pawsome_tag', array( 'pawsome_item' ), $args );
}
add_action( 'init', 'create_pawsome_tag_taxonomy', 0 );


/**
 * Registers the Portfolio Category Taxonomy used for the Portfolio Item Custom Post Type
 */
function create_pawsome_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'pawsome-portfolio' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'pawsome-portfolio' ),
		'menu_name'                  => __( 'Portfolio Category', 'pawsome-portfolio' ),
		'all_items'                  => __( 'All Portfolio Categories', 'pawsome-portfolio' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'pawsome-portfolio' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'pawsome-portfolio' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'pawsome-portfolio' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'pawsome-portfolio' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'pawsome-portfolio' ),
		'update_item'                => __( 'Update Portfolio Category', 'pawsome-portfolio' ),
		'view_item'                  => __( 'View Portfolio Category', 'pawsome-portfolio' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'pawsome-portfolio' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'pawsome-portfolio' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'pawsome-portfolio' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'pawsome-portfolio' ),
		'search_items'               => __( 'Search Portfolio Categories', 'pawsome-portfolio' ),
		'not_found'                  => __( 'Not Found', 'pawsome-portfolio' ),
		'no_terms'                   => __( 'No Portfolio Categories', 'pawsome-portfolio' ),
		'items_list'                 => __( 'Portfolio Categories list', 'pawsome-portfolio' ),
		'items_list_navigation'      => __( 'Portfolio Categories list navigation', 'pawsome-portfolio' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
	);
	register_taxonomy( 'pawsome_category', array( 'pawsome_item' ), $args );
}
add_action( 'init', 'create_pawsome_category_taxonomy', 0 );


/**
 * Make Portfolio Category taxonomy column sortable.
 */
function make_taxonomy_columns_sortable( $columns ) {
	$columns['taxonomy-pawsome_category'] = 'pawsome_category';
	$columns['taxonomy-pawsome_tag']      = 'pawsome_tag';
	return $columns;
}
add_filter( 'manage_edit-pawsome_item_sortable_columns', 'make_taxonomy_columns_sortable' );
