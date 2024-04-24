<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

/**
 * Registers the Custom Post Type used for the Portfolio Item block
 */
function create_portfolio_item_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio Items', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio Item', 'text_domain' ),
		'archives'              => __( 'Portfolio Item Archives', 'text_domain' ),
		'attributes'            => __( 'Portfolio Item Attributes', 'text_domain' ),
		'all_items'             => __( 'All Portfolio Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Portfolio Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Portfolio Item', 'text_domain' ),
		'update_item'           => __( 'Update Portfolio Item', 'text_domain' ),
		'view_item'             => __( 'View Portfolio Item', 'text_domain' ),
		'view_items'            => __( 'View Portfolio Items', 'text_domain' ),
		'search_items'          => __( 'Search Portfolio Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Portfolio Item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio Item', 'text_domain' ),
		'items_list'            => __( 'Portfolio Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Portfolio Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Portfolio Items list', 'text_domain' ),
	);
	$args   = array(
		'label'               => __( 'Portfolio Item', 'text_domain' ),
		'description'         => __( 'You can design pages around each of your portfolio items, then display them by category on any page.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
		'taxonomies'          => array( 'portfolio_tag', ' portfolio_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
		'rewrite'             => array( 'slug' => 'portfolio-item' ),
	);
	register_post_type( 'portfolio_item', $args );
}
add_action( 'init', 'create_portfolio_item_post_type' );
