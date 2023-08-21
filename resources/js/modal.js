"use strict";

/*---- Variable ----*/
var user;
var csrf;
var action;

/*---- Global Function ----*/
// Global function that allows data to be sent from 'accounts.js' to here.
window.sendUserData = function(response, csrfToken, actionURL) {
  user = response;
  csrf = csrfToken;
  action = actionURL;
};

/*---- JQuery ----*/
$(document).ready(function() {
  /*---- Constant Elements ----*/
  const staticBodyElement = $('body');

  /*---- Event Handlers ----*/
  /*---- Close or Cancel Buttons ----*/
  // Add functionality to the close button on the view modal.
  staticBodyElement.on('click', '#panel-close', function(event) {
    event.preventDefault();
    $(this).closest('#viewPanel-modal').remove();
  });

  // Add functionality to the cancel button on the confirmation modal.
  staticBodyElement.on('click', '#modal-cancel', function(event) {
    event.preventDefault();
    $(this).closest('#confirmation-modal').remove();
  });

  // Add functionality to the close button on the edit modal.
  staticBodyElement.on('click', '#panel-close', function(event) {
    event.preventDefault();
    $(this).closest('#editPanel-modal').remove();
  });

  // Used primarily for the edit account modal, mainly when the 'Edit' button is clicked on the modal.
  staticBodyElement.on('click', '#submit', function(event) {
    event.preventDefault();

    // Set the user array to the form in the edit user modal.
    user.email = $('input#email').val();
    user.firstname = $('input#firstname').val();
    user.lastname = $('input#lastname').val();
    user.role = $('select#role-select').find(':selected').text();

    // Send a post request.
    $.post({
      url: '/accounts/update',
      type: 'POST',
      data: {
        user: user,
        action: action
      },
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      success: function (response) {
        // Check to see if the desired outcome has succeeded.
        if (response.success) {
          // If so, send a POST request back to '/accounts' with the success message.
          $.post({
            url: '/accounts',
            type: 'POST',
            data: {
              'success': response.success
            },
            headers: {
              'X-CSRF-TOKEN': csrf
            },
            success: function (response) {
              // If successful, refresh the page (GET) to show the actual success message.
              location.reload();
            }
          });
        } else {
          // If not, send a POST request back to '/accounts' with the error message.
          $.post({
            url: '/accounts',
            type: 'POST',
            data: {
              'error': response.error
            },
            headers: {
              'X-CSRF-TOKEN': csrf
            },
            success: function (response) {
              // If successful, refresh the page (GET) to show the actual error message.
              location.reload();
            }
          });
        }
      }
    });
  });

  // Used primarily for the confirmation modal, mainly when the 'Confirm' button is clicked on the modal.
  staticBodyElement.on('click', '#modal-confirm', function(event) {
    event.preventDefault();

    // Send a post request to '/accounts/update' with the action '/action/remove'.
    $.post({
      url: '/accounts/update',
      type: 'POST',
      data: {
        user: user,
        action: action
      },
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      success: function (response) {
        // Check to see if the desired outcome has succeeded.
        if (response.success) {
          // If so, send a POST request back to '/accounts' with the success message.
          $.post({
            url: '/accounts',
            type: 'POST',
            data: {
              'success': response.success
            },
            headers: {
              'X-CSRF-TOKEN': csrf
            },
            success: function (response) {
              // If successful, refresh the page (GET) to show the actual success message.
              location.reload();
            }
          });
        } else {
          // If not, send a POST request back to '/accounts' with the error message.
          $.post({
            url: '/accounts',
            type: 'POST',
            data: {
              'error': response.error
            },
            headers: {
              'X-CSRF-TOKEN': csrf
            },
            success: function (response) {
              // If successful, refresh the page (GET) to show the actual error message.
              location.reload();
            }
          });
        }
      }
    });
  });
});
