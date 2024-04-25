<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function pawsome_register_block() {
	$block_json = PAWSOME_PLUGIN_PATH . 'build/portfolio/block.json';
	register_block_type(
		$block_json,
		array(
			'render_callback' => 'pawsome_render_portfolio_block',
		)
	);
}

add_action( 'init', 'pawsome_register_block' );
