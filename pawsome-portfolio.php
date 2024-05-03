<?php
/**
 * Plugin Name:       Pawsome Portfolio
 * Plugin URI:        https://david.garden/
 * Description:       A Portfolio Block with a custom Portfolio Item post type that can then be tagged, and filtered by tag
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            wolfpaw
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pawsome-portfolio
 *
 * @package PawsomePortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PAWSOME_PLUGIN_VERSION', '1.0.0' );
define( 'PAWSOME_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Include function files
require_once plugin_dir_path( __FILE__ ) . 'lib/register-post-types.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/register-taxonomies.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/register-blocks.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/render-blocks.php';

/**
 * Setup plugin on activation
 */
function pawsome_activate() {
	// Register post types and taxonomies
	create_pawsome_item_post_type();
	create_pawsome_tag_taxonomy();
	create_pawsome_category_taxonomy();

	// Flush rewrite rules to ensure the new rules for CPTs and taxonomies are recognized
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pawsome_activate' );

/**
 * Cleanup on deactivation
 */
function pawsome_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pawsome_deactivate' );
