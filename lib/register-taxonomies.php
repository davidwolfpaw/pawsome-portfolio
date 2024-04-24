<?php
/**
 * Registers the Portfolio Tag Taxonomy used for the Portfolio Item Custom Post Type
 */
function create_portfolio_tag_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Tags', 'Taxonomy General Name', 'portfolio-tag-filter' ),
		'singular_name'              => _x( 'Portfolio Tag', 'Taxonomy Singular Name', 'portfolio-tag-filter' ),
		'menu_name'                  => __( 'Portfolio Tag', 'portfolio-tag-filter' ),
		'all_items'                  => __( 'All Portfolio Tags', 'portfolio-tag-filter' ),
		'parent_item'                => __( 'Parent Portfolio Tag', 'portfolio-tag-filter' ),
		'parent_item_colon'          => __( 'Parent Portfolio Tag:', 'portfolio-tag-filter' ),
		'new_item_name'              => __( 'New Portfolio Tag Name', 'portfolio-tag-filter' ),
		'add_new_item'               => __( 'Add New Portfolio Tag', 'portfolio-tag-filter' ),
		'edit_item'                  => __( 'Edit Portfolio Tag', 'portfolio-tag-filter' ),
		'update_item'                => __( 'Update Portfolio Tag', 'portfolio-tag-filter' ),
		'view_item'                  => __( 'View Portfolio Tag', 'portfolio-tag-filter' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Tags with commas', 'portfolio-tag-filter' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Tags', 'portfolio-tag-filter' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'portfolio-tag-filter' ),
		'popular_items'              => __( 'Popular Portfolio Tags', 'portfolio-tag-filter' ),
		'search_items'               => __( 'Search Portfolio Tags', 'portfolio-tag-filter' ),
		'not_found'                  => __( 'Not Found', 'portfolio-tag-filter' ),
		'no_terms'                   => __( 'No Portfolio Tags', 'portfolio-tag-filter' ),
		'items_list'                 => __( 'Portfolio Tags list', 'portfolio-tag-filter' ),
		'items_list_navigation'      => __( 'Portfolio Tags list navigation', 'portfolio-tag-filter' ),
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
	register_taxonomy( 'portfolio_tag', array( 'portfolio_item' ), $args );
}
add_action( 'init', 'create_portfolio_tag_taxonomy', 0 );


/**
 * Registers the Portfolio Category Taxonomy used for the Portfolio Item Custom Post Type
 */
function create_portfolio_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'portfolio-tag-filter' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'portfolio-tag-filter' ),
		'menu_name'                  => __( 'Portfolio Category', 'portfolio-tag-filter' ),
		'all_items'                  => __( 'All Portfolio Categories', 'portfolio-tag-filter' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'portfolio-tag-filter' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'portfolio-tag-filter' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'portfolio-tag-filter' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'portfolio-tag-filter' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'portfolio-tag-filter' ),
		'update_item'                => __( 'Update Portfolio Category', 'portfolio-tag-filter' ),
		'view_item'                  => __( 'View Portfolio Category', 'portfolio-tag-filter' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'portfolio-tag-filter' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'portfolio-tag-filter' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'portfolio-tag-filter' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'portfolio-tag-filter' ),
		'search_items'               => __( 'Search Portfolio Categories', 'portfolio-tag-filter' ),
		'not_found'                  => __( 'Not Found', 'portfolio-tag-filter' ),
		'no_terms'                   => __( 'No Portfolio Categories', 'portfolio-tag-filter' ),
		'items_list'                 => __( 'Portfolio Categories list', 'portfolio-tag-filter' ),
		'items_list_navigation'      => __( 'Portfolio Categories list navigation', 'portfolio-tag-filter' ),
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
	register_taxonomy( 'portfolio_category', array( 'portfolio_item' ), $args );
}
add_action( 'init', 'create_portfolio_category_taxonomy', 0 );


/**
 * Make Portfolio Category taxonomy column sortable.
 */
function make_taxonomy_columns_sortable( $columns ) {
	$columns['taxonomy-portfolio_category'] = 'portfolio_category';
	$columns['taxonomy-portfolio_tag']      = 'portfolio_tag';
	return $columns;
}
add_filter( 'manage_edit-portfolio_item_sortable_columns', 'make_taxonomy_columns_sortable' );
