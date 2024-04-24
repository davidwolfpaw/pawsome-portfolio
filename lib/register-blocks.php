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
function register_portfolio_filter_block() {

	// Paths to the JavaScript and CSS files relative to the plugin's root directory
	$js_path               = plugins_url( 'build/portfolio/index.js', __DIR__ );
	$css_path              = plugins_url( 'build/portfolio/style-index.css', __DIR__ );
	$view_path             = plugins_url( 'build/portfolio/view.js', __DIR__ );
	$block_editor_css_path = plugins_url( 'build/portfolio/index.css', __DIR__ );

	// Versioning files based on file modification time
	$js_version         = filemtime( plugin_dir_path( __DIR__ ) . 'build/portfolio/index.js' );
	$css_version        = filemtime( plugin_dir_path( __DIR__ ) . 'build/portfolio/style-index.css' );
	$view_version       = filemtime( plugin_dir_path( __DIR__ ) . 'build/portfolio/view.js' );
	$editor_css_version = filemtime( plugin_dir_path( __DIR__ ) . 'build/portfolio/index.css' );

	// Register the block editor script
	wp_register_script(
		'portfolio-block-editor-script',
		$js_path,
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'wp-data' ),
		$js_version,
		true
	);

	// Register the view script
	wp_register_script(
		'portfolio-view-script',
		$view_path,
		array(),
		$view_version,
		true
	);

	// Register the block style
	wp_register_style(
		'portfolio-block-style',
		$css_path,
		array(),
		$css_version
	);

	// Register the editor style
	wp_register_style(
		'portfolio-block-editor-style',
		$block_editor_css_path,
		array(),
		$editor_css_version
	);

	// Register the block type
	register_block_type(
		'portfolio-tag-filter/portfolio',
		array(
			'$schema'         => 'https://schemas.wp.org/trunk/block.json',
			'apiVersion'      => 3,
			'name'            => 'portfolio-tag-filter/portfolio',
			'version'         => '0.1.0',
			'category'        => 'widgets',
			'icon'            => 'portfolio',
			'description'     => 'A Portfolio Block with Item sub-blocks that can then be tagged, and filtered by tag',
			'supports'        => array(
				'html' => false,
			),
			'textdomain'      => 'portfolio-tag-filter',
			'title'           => 'Portfolio Tag Filter',
			'editor_script'   => 'portfolio-block-editor-script',
			'view_script'     => 'portfolio-view-script',
			'style'           => 'portfolio-block-style',
			'editor_style'    => 'portfolio-block-editor-style',
			'render_callback' => 'render_portfolio_block',
			'attributes'      => array(
				'selected_category'   => array(
					'type'    => 'number',
					'default' => 0,
				),
				'items_per_page'      => array(
					'type'    => 'number',
					'default' => 10,
				),
				'is_linked'           => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'show_featured_image' => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'show_title'          => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'show_excerpt'        => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'show_publish_date'   => array(
					'type'    => 'boolean',
					'default' => false,
				),
			),
		)
	);
}
add_action( 'init', 'register_portfolio_filter_block' );
