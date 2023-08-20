"use strict";

/*---- JQuery ----*/
$(document).ready(function() {
  /*---- Request ----*/
  // Send a GET request to 'recentblogs' to get all blogs.
  $.get({
    url: '/blog/recentblogs',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      // Put the response into a variable, getting the Blog object.
      const blogs = response.blogs;

      // Sort the dates in descending order, meaning the latest blog sits at the top.
      blogs.sort(function(x, y) {
        return new Date(y.created_at) - new Date(x.created_at);
      });

      // Calculate the permitted blogs allowed.
      const recentPostsSectionHeight = $('section#recent-posts').height();
      const rowHeight = 75; // Assume that the max-height of a recent blog div is 90px.
      const recentPostsTitleHeight = $('section#recent-posts > h3').height() + $('section#recent-posts > h3').outerHeight();
      const permittedRecentBlogs = Math.floor((recentPostsSectionHeight - recentPostsTitleHeight) / rowHeight);

      // Iterate through the blogs, ensuring that they do not exceed view height.
      for (let i = 0; i < blogs.length && i < permittedRecentBlogs; i++) {
        const html = `
      <div class="recent-post">
        <img src="${blogs[i].blog_image}" alt="Blog Image">
        <div class="blog-info">
          <h4>${blogs[i].blog_title}</h4>
          <div class="blog-datetime">
            <img src="https://staging.greyareasolutions.net/images/timeicon.png" alt="Date">
            <h5>${new Date(blogs[i].created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}</h5>
          </div>
        </div>
        <a class="recent-post-ref" href="blog/${blogs[i].blog_slug}"></a>
      </div>`;
        // Add the blog to recent posts section.
        $('section#recent-posts').append(html);
      }
    }
  });

  /*---- Event Listener ----*/
  // Set an event listener for the publsih button.
  $('input#publish').on('click', function(event) {
    event.preventDefault();

    // Send a GET request to the confirmation modal.
    $.get({
      url: '/blog/confirm',
      type: 'GET',
      success: function (response) {
        // If success, show the modal.
        $('main').after(response.modal);

        // Set an event listner for the confirm button.
        $('body').on('click', '#modal-confirm', function(event) {
          event.preventDefault();

          // Submit the form on /blog/create.
          $('div#blog-content > form').submit();
        });

        // Set an event listener for the cancel button.
        $('body').on('click', '#modal-cancel', function(event) {
          event.preventDefault();

          // Remove the modal from the HTML.
          $(this).closest('#confirmation-modal').remove();
        });
      }
    });
  });
});
