<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the Portfolio block
 */
function pawsome_render_portfolio_block( $attributes ) {

	global $post;
	$is_admin  = is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX );
	$is_editor = isset( $_REQUEST['context'] ) && 'edit' === $_REQUEST['context'];

	if ( empty( $attributes['selected_category'] ) ) {
		return 'Please select a category.';
	}

	$selected_category   = $attributes['selected_category'];
	$use_filter_tags     = $attributes['use_filter_tags'];
	$show_featured_image = $attributes['show_featured_image'];
	$show_title          = $attributes['show_title'];
	$show_excerpt        = $attributes['show_excerpt'];
	$show_tags           = $attributes['show_tags'];
	$show_publish_date   = $attributes['show_publish_date'];
	$show_modified_date  = $attributes['show_modified_date'];

	$output = '<div class="pawsome-portfolio ' . $attributes['className'] . '" data-link-behavior="' . esc_attr( $attributes['link_behavior'] ) . '">';

	$args  = array(
		'post_type'      => 'pawsome_item',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'pawsome_category',
				'field'    => 'term_id',
				'terms'    => $selected_category,
			),
		),
	);
	$query = new WP_Query( $args );

	if ( $use_filter_tags ) {
		$tags = array();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_tags = get_the_terms( get_the_ID(), 'pawsome_tag' );
				if ( ! is_wp_error( $post_tags ) && ! empty( $post_tags ) ) {
					foreach ( $post_tags as $post_tag ) {
						if ( ! isset( $tags[ $post_tag->term_id ] ) ) {
							$tags[ $post_tag->term_id ] = array(
								'name'  => $post_tag->name,
								'count' => 0,
							);
						}
						++$tags[ $post_tag->term_id ]['count'];
					}
				}
			}
			wp_reset_postdata();
		}

		// Display tags as buttons
		if ( ! empty( $tags ) ) {
			$output .= '<div class="pawsome-portfolio-tag-buttons">';
			foreach ( $tags as $tag_id => $tag_info ) {
				$output .= '<button class="pawsome-portfolio-tag-button" data-tag-id="' . esc_attr( $tag_id ) . '">'
				. esc_html( $tag_info['name'] ) . ' (' . $tag_info['count'] . ')</button>';
			}
			$output .= '</div>';
		}
	}

	// Display posts
	if ( $query->have_posts() ) {
		$output .= '<div class="pawsome-portfolio-items">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$permalink = get_permalink();
			$post_id   = get_the_ID();
			$post_tags = get_the_terms( get_the_ID(), 'pawsome_tag' );

			if ( ! is_wp_error( $post_tags ) && ! empty( $post_tags ) ) {
				$tag_ids = array_map(
					function ( $tag ) {
						return $tag->term_id;
					},
					$post_tags
				);
			}

			if ( 'page' === $attributes['link_behavior'] ) {
				$output .= '<a href="' . esc_url( $permalink ) . '" class="pawsome-portfolio-item-link">';
			}
			$output .= '<div class="pawsome-portfolio-item" data-post-id="' . esc_attr( $post_id ) . '" data-tag-ids="' . esc_attr( wp_json_encode( $tag_ids ) ) . '">';

			if ( $show_featured_image ) {
				$output .= get_the_post_thumbnail( $post_id, 'thumbnail' );
			}
			if ( $show_title ) {
				$output .= '<h2>' . get_the_title() . '</h2>';
			}
			if ( $show_excerpt ) {
				$output .= '<p>' . get_the_excerpt() . '</p>';
			}
			if ( $show_tags ) {
				// Fetch and display tags
				$tags = get_the_terms( $post_id, 'pawsome_tag' );  // Adjust the taxonomy if you use a custom taxonomy
				if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
					$output .= '<div class="portfolio-tags">';
					foreach ( $tags as $tag ) {
						$output .= '<span class="tag">' . esc_html( $tag->name ) . '</span> ';
					}
					$output .= '</div>';
				}
			}
			if ( $show_publish_date ) {
				$output .= '<p>' . get_the_date() . '</p>';
			}
			if ( $show_modified_date ) {
				$output .= '<p>' . get_the_modified_date() . '</p>';
			}

			$output .= '</div>';
			if ( 'page' === $attributes['link_behavior'] ) {
				$output .= '</a>';
			}
		}
		$output .= '</div>';
		wp_reset_postdata();
	}

	// Modal container
	if ( 'modal' === $attributes['link_behavior'] ) {
		$output .= '<div id="pawsome-modal-container"><div id="pawsome-modal"><span class="close">&times;</span><div class="pawsome-modal-content"></div></div></div>';
	}

	$output .= '</div>';
	return $output;
}
