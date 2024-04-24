<?php
/**
 * Plugin Name:       Portfolio Tag Filter
 * Plugin URI:        https://david.garden/
 * Description:       A Portfolio Block with Item sub-blocks that can then be tagged, and filtered by tag
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            wolfpaw
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       portfolio-tag-filter
 *
 * @package PortfolioTagFilter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PLUGIN_VERSION', '0.1.0' );

// Include function files
require_once plugin_dir_path( __FILE__ ) . 'lib/register-post-types.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/register-taxonomies.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/register-blocks.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/render-blocks.php';
