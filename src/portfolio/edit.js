/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl } from '@wordpress/components';
import { withSelect } from '@wordpress/data';
import { useState } from '@wordpress/element';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

const Edit = ({ attributes, setAttributes, categories, className }) => {
	const { selected_category, is_linked, show_featured_image, show_title, show_excerpt, show_publish_date } = attributes;

	// Update the selected category
	const updateCategory = (selected_category) => {
		setAttributes({ selected_category: selected_category ? parseInt(selected_category) : null });
	};

	return (
		<div {...useBlockProps({ className })}>
			<InspectorControls>
				<PanelBody title="Category Settings">
					<SelectControl
						label="Select Portfolio Category"
						value={selected_category}
						options={[
							{ label: 'Select a Category', value: '' }, // Null option
							...categories.map(category => ({
								label: category.name,
								value: category.id
							}))
						]}
						onChange={updateCategory}
					/>
				</PanelBody>
				<PanelBody title="Display Settings">
					<ToggleControl
						label="Link Portfolio Items"
						checked={is_linked}
						onChange={(value) => setAttributes({ is_linked: value })}
					/>
					<ToggleControl
						label="Show Featured Image"
						checked={show_featured_image}
						onChange={(value) => setAttributes({ show_featured_image: value })}
					/>
					<ToggleControl
						label="Show Title"
						checked={show_title}
						onChange={(value) => setAttributes({ show_title: value })}
					/>
					<ToggleControl
						label="Show Excerpt"
						checked={show_excerpt}
						onChange={(value) => setAttributes({ show_excerpt: value })}
					/>
					<ToggleControl
						label="Show Publish Date"
						checked={show_publish_date}
						onChange={(value) => setAttributes({ show_publish_date: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div>
				{selected_category ? (
					<p>Preview of posts in "{categories.find(cat => cat.id === selected_category)?.name}" will be shown here based on settings.</p>
				) : (
					<p>Select a category to see posts preview.</p>
				)}
			</div>
		</div>
	);
};

export default withSelect((select) => {
	const { getEntityRecords } = select('core');
	const categories = getEntityRecords('taxonomy', 'pawsome_category', { per_page: -1 });
	return {
		categories: categories || []
	};
})(Edit);
