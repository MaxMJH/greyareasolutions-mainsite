/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/recentblogs.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);


/*---- JQuery ----*/
$(document).ready(function () {
  /*---- Request ----*/
  // Send a GET request to 'recentblogs' to get all blogs.
  $.get({
    url: '/blog/recentblogs',
    type: 'GET',
    dataType: 'json',
    success: function success(response) {
      // Put the response into a variable, getting the Blog object.
      var blogs = response.blogs;

      // Sort the dates in descending order, meaning the latest blog sits at the top.
      blogs.sort(function (x, y) {
        return new Date(y.created_at) - new Date(x.created_at);
      });

      // Calculate the permitted blogs allowed.
      var recentPostsSectionHeight = $('section#recent-posts').height();
      var rowHeight = 75; // Assume that the max-height of a recent blog div is 90px.
      var recentPostsTitleHeight = $('section#recent-posts > h3').height() + $('section#recent-posts > h3').outerHeight();
      var permittedRecentBlogs = Math.floor((recentPostsSectionHeight - recentPostsTitleHeight) / rowHeight);

      // Iterate through the blogs, ensuring that they do not exceed view height.
      for (var i = 0; i < blogs.length && i < permittedRecentBlogs; i++) {
        var html = "\n      <div class=\"recent-post\">\n        <img src=\"".concat(blogs[i].blog_image, "\" alt=\"Blog Image\">\n        <div class=\"blog-info\">\n          <h4>").concat(blogs[i].blog_title, "</h4>\n          <div class=\"blog-datetime\">\n            <img src=\"https://staging.greyareasolutions.net/images/timeicon.png\" alt=\"Date\">\n            <h5>").concat(new Date(blogs[i].created_at).toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'short',
          day: 'numeric'
        }), "</h5>\n          </div>\n        </div>\n        <a class=\"recent-post-ref\" href=\"/blog/").concat(blogs[i].blog_slug, "\"></a>\n      </div>");
        // Add the blog to recent posts section.
        $('section#recent-posts').append(html);
      }
    }
  });

  /*---- Event Listener ----*/
  // Set an event listener for the publsih button.
  $('input#publish').on('click', function (event) {
    event.preventDefault();
    var lastUrl = window.location.href;
    var action = lastUrl.split('/');
    action = action[action.length - 1];
    switch (action) {
      case 'create':
        // Send a GET request to the confirmation modal.
        $.get({
          url: '/blog/create/confirm',
          type: 'GET',
          success: function success(response) {
            // If success, show the modal.
            $('main').after(response.modal);

            // Set an event listner for the confirm button.
            $('body').on('click', '#modal-confirm', function (event) {
              event.preventDefault();

              // Submit the form on /blog/create.
              $('div#blog-content > form').submit();
            });

            // Set an event listener for the cancel button.
            $('body').on('click', '#modal-cancel', function (event) {
              event.preventDefault();

              // Remove the modal from the HTML.
              $(this).closest('#confirmation-modal').remove();
            });
          }
        });
        break;
      case 'edit':
        // Get the current blog url.
        var url = window.location.href + '/confirm';

        // Send a GET request to the confirmation modal.
        $.get({
          url: url,
          type: 'GET',
          success: function success(response) {
            // If success, show the modal.
            $('main').after(response.modal);

            // Set an event listner for the confirm button.
            $('body').on('click', '#modal-confirm', function (event) {
              event.preventDefault();

              // Submit the form on /blog/create.
              $('div#blog-content > form').submit();
            });

            // Set an event listener for the cancel button.
            $('body').on('click', '#modal-cancel', function (event) {
              event.preventDefault();

              // Remove the modal from the HTML.
              $(this).closest('#confirmation-modal').remove();
            });
          }
        });
        break;
    }
  });

  // Set an event listener for the delete button.
  $('button#remove').on('click', function (event) {
    event.preventDefault();

    // Get the current blog url.
    var url = window.location.href + '/remove/confirm';

    // Send a GET request to the confirmation modal.
    $.get({
      url: url,
      type: 'GET',
      success: function success(response) {
        // If success, show the modal.
        $('body').append(response.modal);

        // Set an event listener for the confirm modal.
        $('body').on('click', '#modal-confirm', function (event) {
          event.preventDefault();

          // Submit the form on /blog/{blog_slug}/remove.
          $('form#remove').submit();
        });

        // Set an event listener for the cancel button.
        $('body').on('click', '#modal-cancel', function (event) {
          event.preventDefault();

          // Remvove the modal from HTML.
          $(this).closest('#confirmation-modal').remove();
        });
      }
    });
  });
});
/******/ })()
;