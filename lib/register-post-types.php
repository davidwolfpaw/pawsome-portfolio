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
function create_pawsome_item_post_type() {

	$labels = array(
		'name'                  => _x( 'Pawsome Portfolio Items', 'Post Type General Name', 'pawsome-portfolio' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'pawsome-portfolio' ),
		'menu_name'             => __( 'Pawsome', 'pawsome-portfolio' ),
		'name_admin_bar'        => __( 'Portfolio Item', 'pawsome-portfolio' ),
		'archives'              => __( 'Portfolio Item Archives', 'pawsome-portfolio' ),
		'attributes'            => __( 'Portfolio Item Attributes', 'pawsome-portfolio' ),
		'all_items'             => __( 'All Portfolio Items', 'pawsome-portfolio' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'pawsome-portfolio' ),
		'add_new'               => __( 'Add New', 'pawsome-portfolio' ),
		'new_item'              => __( 'New Portfolio Item', 'pawsome-portfolio' ),
		'edit_item'             => __( 'Edit Portfolio Item', 'pawsome-portfolio' ),
		'update_item'           => __( 'Update Portfolio Item', 'pawsome-portfolio' ),
		'view_item'             => __( 'View Portfolio Item', 'pawsome-portfolio' ),
		'view_items'            => __( 'View Portfolio Items', 'pawsome-portfolio' ),
		'search_items'          => __( 'Search Portfolio Item', 'pawsome-portfolio' ),
		'not_found'             => __( 'Not found', 'pawsome-portfolio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'pawsome-portfolio' ),
		'featured_image'        => __( 'Featured Image', 'pawsome-portfolio' ),
		'set_featured_image'    => __( 'Set featured image', 'pawsome-portfolio' ),
		'remove_featured_image' => __( 'Remove featured image', 'pawsome-portfolio' ),
		'use_featured_image'    => __( 'Use as featured image', 'pawsome-portfolio' ),
		'insert_into_item'      => __( 'Insert into Portfolio Item', 'pawsome-portfolio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio Item', 'pawsome-portfolio' ),
		'items_list'            => __( 'Portfolio Items list', 'pawsome-portfolio' ),
		'items_list_navigation' => __( 'Portfolio Items list navigation', 'pawsome-portfolio' ),
		'filter_items_list'     => __( 'Filter Portfolio Items list', 'pawsome-portfolio' ),
	);
	$args   = array(
		'label'               => __( 'Portfolio Item', 'pawsome-portfolio' ),
		'description'         => __( 'You can design pages around each of your portfolio items, then display them by category on any page.', 'pawsome-portfolio' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
		'taxonomies'          => array( 'pawsome_tag', ' pawsome_category' ),
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
	register_post_type( 'pawsome_item', $args );
}
add_action( 'init', 'create_pawsome_item_post_type' );

function pawsome_register_year_meta() {
	register_post_meta(
		'pawsome_item',
		'_pawsome_year',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
		)
	);
}
add_action( 'init', 'pawsome_register_year_meta' );

function pawsome_year_meta_box() {
	add_meta_box(
		'pawsome_year',
		'Project Year',
		'pawsome_year_meta_box_html',
		'pawsome_item',
		'side'
	);
}
add_action( 'add_meta_boxes', 'pawsome_year_meta_box' );

function pawsome_year_meta_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_pawsome_year', true );
	wp_nonce_field( 'pawsome_year_nonce', 'pawsome_year_nonce' );
	echo '<input type="number" name="pawsome_year" value="' . esc_attr( $value ) . '" min="1900" max="2100" style="width:100%" />';
}

function pawsome_save_year_meta( $post_id ) {
	if ( ! isset( $_POST['pawsome_year_nonce'] ) || ! wp_verify_nonce( $_POST['pawsome_year_nonce'], 'pawsome_year_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['pawsome_year'] ) ) {
		update_post_meta( $post_id, '_pawsome_year', sanitize_text_field( $_POST['pawsome_year'] ) );
	}
}
add_action( 'save_post_pawsome_item', 'pawsome_save_year_meta' );
