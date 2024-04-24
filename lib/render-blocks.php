<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the Portfolio block
 */
function render_portfolio_block( $attributes ) {

	global $post;

	if ( empty( $attributes['selected_category'] ) ) {
		return 'Please select a category.';
	}

	$selected_category   = $attributes['selected_category'];
	$is_linked           = $attributes['is_linked'];
	$show_featured_image = $attributes['show_featured_image'];
	$show_title          = $attributes['show_title'];
	$show_excerpt        = $attributes['show_excerpt'];
	$show_publish_date   = $attributes['show_publish_date'];

	$output = '<div class="portfolio-block">';

	$paged          = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$items_per_page = ! empty( $attributes['items_per_page'] ) ? $attributes['items_per_page'] : 10;

	$args  = array(
		'post_type'      => 'portfolio_item',
		'posts_per_page' => $items_per_page,
		'paged'          => $paged,
		'tax_query'      => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'term_id',
				'terms'    => $selected_category,
			),
		),
	);
	$query = new WP_Query( $args );
	$tags  = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_tags = get_the_terms( get_the_ID(), 'portfolio_tag' );
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
		$output .= '<div class="portfolio-tag-buttons">';
		foreach ( $tags as $tag_id => $tag_info ) {
			$output .= '<button class="portfolio-tag-button" data-tag-id="' . esc_attr( $tag_id ) . '">'
				. esc_html( $tag_info['name'] ) . ' (' . $tag_info['count'] . ')</button>';
		}
		$output .= '</div>';
	}

	// Display posts
	if ( $query->have_posts() ) {
		$output .= '<div class="portfolio-items">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$permalink = get_permalink();
			$post_tags = get_the_terms( get_the_ID(), 'portfolio_tag' );
			if ( ! is_wp_error( $post_tags ) && ! empty( $post_tags ) ) {
				$tag_ids = array_map(
					function ( $tag ) {
						return $tag->term_id;
					},
					$post_tags
				);

				if ( ! empty( $is_linked ) && $is_linked ) {
					$output .= '<a href="' . esc_url( $permalink ) . '" class="portfolio-item-link">';
				}
				$output .= '<div class="portfolio-item" data-tag-ids="' . esc_attr( wp_json_encode( $tag_ids ) ) . '">';

				if ( $show_featured_image ) {
					$output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
				}
				if ( $show_title ) {
					$output .= '<h2>' . get_the_title() . '</h2>';
				}
				if ( $show_excerpt ) {
					$output .= '<p>' . get_the_excerpt() . '</p>';
				}
				if ( $show_publish_date ) {
					$output .= '<p>' . get_the_date() . '</p>';
				}

				$output .= '</div>';
				if ( ! empty( $is_linked ) && $is_linked ) {
					$output .= '</a>';
				}
			}
		}
		$output .= '</div>';
		wp_reset_postdata();
	}

	// Add pagination links
	$output .= paginate_links(
		array(
			'total'    => $query->max_num_pages,
			'current'  => $paged,
			'format'   => '?paged=%#%',
			'show_all' => false,
			'type'     => 'plain',
		)
	);

	$output .= '</div>';
	return $output;
}
