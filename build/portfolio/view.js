/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./src/portfolio/view.js ***!
  \*******************************/
/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.pawsome-portfolio-tag-button');
  const items = document.querySelectorAll('.pawsome-portfolio-item');
  const clearButton = document.createElement('button');
  clearButton.textContent = 'Clear Tags';
  clearButton.className = 'clear-tags-button';

  // Append the clear button after the last tag button
  if (buttons.length > 0) {
    buttons[buttons.length - 1].parentNode.appendChild(clearButton);
  }
  let selectedTags = [];
  buttons.forEach(button => {
    button.addEventListener('click', function () {
      const tagId = parseInt(this.getAttribute('data-tag-id'));
      const index = selectedTags.indexOf(tagId);
      if (index > -1) {
        // Remove tag from array
        selectedTags.splice(index, 1);
        this.classList.remove('active');
      } else {
        // Add tag to array
        selectedTags.push(tagId);
        this.classList.add('active');
      }
      filterPosts();
    });
  });

  // Clear all selected tags
  clearButton.addEventListener('click', function () {
    selectedTags = [];
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
/******/ })()
;
//# sourceMappingURL=view.js.map