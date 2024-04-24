/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

document.addEventListener('DOMContentLoaded', function () {
	const buttonsContainer = document.querySelector('.pawsome-portfolio-tag-buttons'); // Adjust if your tags have a specific container
	const buttons = document.querySelectorAll('.pawsome-portfolio-tag-button');
	const items = document.querySelectorAll('.pawsome-portfolio-item');
	const clearButton = document.createElement('button');

	clearButton.textContent = 'Clear Tags';
	clearButton.className = 'clear-tags-button';

	// Append the clear button after the last tag button
	if (buttons.length > 0) {
		buttons[buttons.length - 1].parentNode.appendChild(clearButton);
	} else {
		buttonsContainer.appendChild(clearButton); // Fallback if no buttons exist
	}

	let selectedTags = [];

	buttons.forEach(button => {
		button.addEventListener('click', function () {
			const tagId = parseInt(this.getAttribute('data-tag-id'));
			const index = selectedTags.indexOf(tagId);
			if (index > -1) {
				selectedTags.splice(index, 1); // Remove tag from array
				this.classList.remove('active');
			} else {
				selectedTags.push(tagId); // Add tag to array
				this.classList.add('active');
			}
			filterPosts();
		});
	});

	clearButton.addEventListener('click', function () {
		selectedTags = []; // Clear all selected tags
		buttons.forEach(button => button.classList.remove('active'));
		items.forEach(item => item.style.display = '');
	});

	function filterPosts() {
		if (selectedTags.length > 0) {
			items.forEach(item => {
				const tags = JSON.parse(item.getAttribute('data-tag-ids'));
				const isMatch = tags.some(tag => selectedTags.includes(tag));
				item.style.display = isMatch ? '' : 'none';
			});
		} else {
			items.forEach(item => item.style.display = '');
		}
	}
});
