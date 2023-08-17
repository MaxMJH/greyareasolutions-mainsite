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
/*!**********************************!*\
  !*** ./resources/js/accounts.js ***!
  \**********************************/
__webpack_require__.r(__webpack_exports__);


/*---- JQuery ----*/
$(document).ready(function () {
  /*---- Constant Element ----*/
  var buttonElements = $('form.user-options > button');

  /*---- Variables ----*/
  var csrf;
  var userId;
  var jsonResponse;

  /*---- Event Handler ----*/
  // Add event listeners to the three options.
  buttonElements.on('click', function (event) {
    // Prevent the default 'submit' and replace with the following code.
    event.preventDefault();

    // Get the currently pressed button.
    var buttonElement = $(event.target.parentElement);

    // Get the inputs of the clicked button.
    var inputElements = $(buttonElement.siblings());

    // From the inputs, get the CSRF token and the User ID.
    csrf = $(inputElements[0]).val();
    userId = $(inputElements[1]).val();

    // Get the form of the clicked button.
    var formElement = $(buttonElement.parent());

    // From the form, get the intended action.
    var action = formElement.attr('action');

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
        user_id: userId,
        action: action
      },
      headers: {
        'X-CSRF-TOKEN': csrf
      },
      success: function success(response) {
        // Show the respective modal.
        showModal(action, response);

        // Send the data to 'modal.js'.
        sendUserData(response.user, csrf, response.action);
      }
    });
  }

  // If POST succeeded, show the respective modal.
  function showModal(action, response) {
    // Add the modal to the view.
    $('main').after(response.modal);
  }
});
/******/ })()
;