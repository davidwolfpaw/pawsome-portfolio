/******/ (() => { // webpackBootstrap
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
  const portfolioItems = document.querySelectorAll('.pawsome-portfolio-item');
  const tagButtons = document.querySelectorAll('.pawsome-portfolio-tag-button');
  const clearButton = document.createElement('button');
  const params = new URLSearchParams(window.location.search);
  let selectedTags = params.get('tags') ? params.get('tags').split(',').map(Number) : [];
  clearButton.textContent = 'Clear Tags';
  clearButton.className = 'clear-tags-button';

  // Append the clear button after the last tag button
  if (tagButtons.length > 0) {
    tagButtons[tagButtons.length - 1].parentNode.appendChild(clearButton);
  }
  tagButtons.forEach(button => {
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
    tagButtons.forEach(button => button.classList.remove('active'));
    portfolioItems.forEach(item => item.style.display = '');
  });

  // Update URL with a query string for selected tags
  tagButtons.forEach(tag => {
    tag.addEventListener('click', function () {
      const tagId = parseInt(this.dataset.tagId);
      const params = new URLSearchParams(window.location.search);
      let selectedTags = params.get('tags') ? params.get('tags').split(',').map(Number) : [];
      const index = selectedTags.indexOf(tagId);
      if (index > -1) {
        // Remove tag if it's already in the array
        selectedTags.splice(index, 1);
      } else {
        // Add tag to the array
        selectedTags.push(tagId);
      }

      // Update the URL, converting array to comma-separated string
      params.set('tags', selectedTags.join(','));
      window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
    });
  });

  // Ensures that tags in query string are filtered on page load
  selectedTags.forEach(tagId => {
    const tagElement = document.querySelector(`.pawsome-portfolio-tag-button[data-tag-id="${tagId}"]`);
    if (tagElement) {
      tagElement.classList.add('active');
    }
    filterPosts();
  });

  // Filter posts based on selected tags
  function filterPosts() {
    if (selectedTags.length > 0) {
      portfolioItems.forEach(item => {
        const tags = JSON.parse(item.getAttribute('data-tag-ids'));
        const isMatch = tags.some(tag => selectedTags.includes(tag));
        item.style.display = isMatch ? '' : 'none';
      });
    } else {
      portfolioItems.forEach(item => item.style.display = '');
    }
  }

  // Build modal lightbox to display portfolio item content
  const portfolioContainer = document.querySelector('.pawsome-portfolio');
  const linkBehavior = portfolioContainer.getAttribute('data-link-behavior');

  // Only if the link behavior has been set to modal
  if (linkBehavior === 'modal') {
    const modal = document.getElementById('pawsome-modal-container');
    const closeButton = modal.querySelector('.close');

    // Add click event listeners to each portfolio item
    portfolioItems.forEach(item => {
      item.addEventListener('click', function () {
        const postId = this.dataset.postId;
        fetch(`/wp-json/wp/v2/pawsome_item/${postId}`).then(response => response.json()).then(post => {
          showModal(post);
        });
      });
    });
    let lastFocusedElement;

    // Function to open the modal
    async function showModal(post) {
      lastFocusedElement = document.activeElement; // Save the currently focused element
      const modalContent = modal.querySelector('.pawsome-modal-content');
      modalContent.innerHTML = `
	            <h2>${post.title.rendered}</h2>
	            ${post.featured_image_src ? `<img src="${post.featured_image_src}" alt="${post.title.rendered}">` : ''}
	            ${post.content.rendered}
	        `;
      modal.style.display = 'flex';
      modalContent.focus();
    }

    // Function to close the modal
    function closeModal() {
      modal.style.display = 'none';
      if (lastFocusedElement) {
        // Return focus to the element that opened the modal
        lastFocusedElement.focus();
      }
    }

    // Event listener for close button
    closeButton.addEventListener('click', closeModal);

    // Event listener for escape key
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });

    // Event listener for clicking anywhere outside of the modal content
    modal.addEventListener('click', function (event) {
      if (event.target === modal) {
        closeModal();
      }
    });
  }
});
/******/ })()
;
//# sourceMappingURL=view.js.map