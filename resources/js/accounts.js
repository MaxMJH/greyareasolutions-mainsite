"use strict";

/*---- JQuery ----*/
$(document).ready(function() {
  /*---- Constant Element ----*/
  const buttonElements = $('form.user-options > button');

  /*---- Variables ----*/
  var csrf;
  var userId;

  /*---- Event Handler ----*/
  buttonElements.on('click', function(event) {
    // Prevent the default 'submit' and replace with the following code.
    event.preventDefault();

    // Get the currently pressed button.
    const buttonElement = $(event.target.parentElement);

    // Get the inputs of the clicked button.
    const inputElements = $(buttonElement.siblings());

    // From the inputs, get the CSRF token and the User ID.
    csrf = $(inputElements[0]).val();
    userId = $(inputElements[1]).val();

    // Get the form of the clicked button.
    const formElement = $(buttonElement.parent());

    // From the form, get the intended action.
    const action = formElement.attr('action');

    // Process each action based on their value.
    switch (action) {
      case '/accounts/view':
        sendPost(action);
        break;
      case '/accounts/edit':
        sendPost(action);
        break;
      case '/accounts/remove':
        sendPost(action);
        break;
    }

  });

  /*---- Functions ----*/
  // Send a post request to the respected routes.
  function sendPost(action) {
    $.post({
      url: action,
      type: 'POST',
      dataType: 'json',
      data: {
        user_id: userId
      },
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      success: function (response) {
        // If POST succeeded, show the respective modal.
        $('main').after(response.modal);
      }
    });
  }
});
