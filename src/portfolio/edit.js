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
import ServerSideRender from '@wordpress/server-side-render';
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

const Edit = ({ attributes, setAttributes, categories }) => {
	const blockProps = useBlockProps();
	const { selected_category, link_behavior, use_filter_tags, show_featured_image, show_title, show_excerpt, show_tags, show_publish_date, show_modified_date } = attributes;

	// Update the selected category
	const updateCategory = (selected_category) => {
		setAttributes({ selected_category: selected_category ? parseInt(selected_category) : null });
	};

	return (
		<div {...blockProps}>
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

				<PanelBody title="Link Settings">
					<SelectControl
						label="Link Behavior"
						value={link_behavior}
						options={[
							{ label: 'None', value: 'none' },
							{ label: 'Link to Page', value: 'page' },
							{ label: 'Open as Modal', value: 'modal' }
						]}
						onChange={(value) => setAttributes({ link_behavior: value })}
					/>
				</PanelBody>

				<PanelBody title="Display Settings">
					<ToggleControl
						label="Display Filter Tags"
						checked={use_filter_tags}
						onChange={(value) => setAttributes({ use_filter_tags: value })}
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
						label="Show Tags"
						checked={show_tags}
						onChange={(value) => setAttributes({ show_tags: value })}
					/>
					<ToggleControl
						label="Show Publish Date"
						checked={show_publish_date}
						onChange={(value) => setAttributes({ show_publish_date: value })}
					/>
					<ToggleControl
						label="Show Modified Date"
						checked={show_modified_date}
						onChange={(value) => setAttributes({ show_modified_date: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender
				block="pawsome-portfolio/portfolio"
				attributes={attributes}
			/>
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
