/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,

	/**
	 * PHP function for server-side rendering
	 */
	render_callback: 'pawsome_render_portfolio_block',
});

/**
 * Create Block Styles
 */
wp.blocks.registerBlockStyle(metadata.name, [
	{
		name: 'portfolio-card',
		label: 'Card',
		description: 'Display the portfolio item as a card with a featured image.',
		isDefault: true,
	},
	{
		name: 'portfolio-list',
		label: 'List',
		description: 'Display the portfolio item in a list view without a featured image.',
	}
]);
