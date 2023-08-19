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
  var users;

  /*---- Start-up Functions ----*/
  // When the script loads, send a GET request to '/accounts/allusers' to get all users.
  $.get({
    url: '/accounts/allusers',
    type: 'GET',
    dataType: 'json',
    success: function success(response) {
      users = response.users;
      setupTable(users);
    }
  });

  /*---- Event Handler ----*/
  // Add event listeners to the three options.
  $('div#table').on('click', '.button', function (event) {
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

  // Add event listener to the select element.
  $('select#search-select').on('change', function () {
    // If the select has been changed, ensure that the input is set to empty.
    $('input#search-value').val('');

    // Essentially display all users.
    setupTable(users);
  });

  // Add event listener to search input element to check when a key is pressed.
  $('input#search-value').on('keyup', function () {
    // Get the value of the search select element.
    var searchCriteria = $('select#search-select').val();

    // Get the value of the search input element.
    var searchValue = $(this).val().toLowerCase().trim();

    // Check to see if the search input element's value is 'empty'.
    if (searchValue !== '') {
      // If so, start finding users that match search input value.
      // Create an empty array to store matching users.
      var matchedCriteria = new Array();

      // Check if the search select is set to 'fullname'.
      if (searchCriteria === 'fullname') {
        // If so, iterate through the users.
        for (var i = 0; i < users.length; i++) {
          // As fullname is not a key, firstname and lastname need to be concatenated to create fullname.
          var firstname = users[i]['firstname'].toLowerCase();
          var lastname = users[i]['lastname'].toLowerCase();
          var fullname = "".concat(firstname, " ").concat(lastname);

          // Check to see if any part of the user's full name matches the search input.
          if (fullname.includes(searchValue)) {
            // If so, push it to the array.
            matchedCriteria.push(users[i]);
          }
        }
      } else {
        // If not, look for matches as normal.
        for (var _i = 0; _i < users.length; _i++) {
          // Get the value found at the searchCriteria key, and turn it into a lowercase string.
          var sievedValue = ('' + users[_i][searchCriteria]).toLowerCase();

          // Check to see if there is a match.
          if (sievedValue.includes(searchValue)) {
            // If so, push it to the array.
            matchedCriteria.push(users[_i]);
          }
        }
      }

      // Display matched users.
      setupTable(matchedCriteria);
    } else {
      // If not, display all users.
      setupTable(users);
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

  // Show the table with user contents.
  function setupTable(users) {
    var tableHeight = $('div#table').height();
    var nextBackElementHeight = $('div#table-next-back').height();
    var rowHeight = $('div#table > table > tbody > tr').height();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var pagesNeeded = 0;
    var currentPage = 1;
    var indexStart = 0;
    var indexEnd = 0;

    // Calculate the current height of the table, and how many rows can fit.
    var permittedRows = Math.floor((tableHeight - (rowHeight + nextBackElementHeight)) / rowHeight);

    // Calculat the pages needed to show users.
    pagesNeeded = Math.ceil(users.length / permittedRows);

    // Display the total number of pages needed.
    $('span').text("1 of ".concat(pagesNeeded));

    // Depending on the result, grab those that fit, if the number exceeds,
    // signify a another page will be needed.
    if (users.length > permittedRows) {
      // Initially, set indexEnd to the max number of rows that fit.
      indexEnd = permittedRows;

      // Grab the users based on which page they sit in.
      var currentUsersBatch = users.slice(indexStart, indexEnd);

      // Add those users to the table.
      parseData(currentUsersBatch, csrfToken);

      // Add an event listener to check if the back button is clicked.
      $('button#back').on('click', function () {
        // Check to see if the current is not the first page.
        if (currentPage !== 1) {
          // If so, decrement the current page, and fetch those that are assigned to that page.
          currentPage--;
          indexEnd = indexStart;
          indexStart -= permittedRows;
          currentUsersBatch = users.slice(indexStart, indexEnd);

          // Add those users to the table.
          parseData(currentUsersBatch, csrfToken);

          // Display the current page.
          $('span').text("".concat(currentPage, " of ").concat(pagesNeeded));
        }
      });

      // Add an event listener to check if the next button is clicked.
      $('button#next').on('click', function () {
        // Check to see if the current page is not the last page.
        if (currentPage !== pagesNeeded) {
          // If so, increment the current page, and fetch those that are assigned to that page.
          currentPage++;
          indexStart = indexEnd;
          indexEnd += permittedRows;
          currentUsersBatch = users.slice(indexStart, indexEnd);

          // Add those users to the table.
          parseData(currentUsersBatch, csrfToken);

          // Display the current page.
          $('span').text("".concat(currentPage, " of ").concat(pagesNeeded));
        }
      });

      // Display the buttons to cycle through pages.
      $('div#table-next-back > button').css('visibility', 'visible');
    } else {
      // Create and add the rows to the table.
      parseData(users, csrfToken);
    }
  }

  // Adds users to the table, based on passed array.
  function parseData(users, csrfToken) {
    // Get the element to which the rows will be added to.
    var tableBody = $('div#table > table > tbody');

    // Before any users are added, clear the table, bar the first row.
    $('tbody > tr').not(':first').remove();

    // Iterate through each user, adding them to the table.
    for (var i = 0; i < users.length; i++) {
      var rowHtml = "\n              <tr>\n                <td>".concat(users[i].user_id, "</td>\n                <td>").concat(users[i].email, "</td>\n                <td>").concat(users[i].firstname, " ").concat(users[i].lastname, "</td>\n                <td>").concat(users[i].role, "</td>\n                <td>").concat(users[i].is_locked, "</td>\n                <td>\n                  <div id=\"options\">\n                    <form id=\"view-more\" class=\"user-options\" action=\"/accounts/view\" method=\"POST\">\n                      <input name=\"_token\" value=\"").concat(csrfToken, "\" type=\"hidden\">\n                      <input type=\"hidden\" name=\"userid\" value=\"").concat(users[i].user_id, "\">\n                      <button type=\"submit\" class=\"button\" name=\"view-more\">\n                        <img id=\"view-more\" src=\"https://staging.greyareasolutions.net/images/viewmoreicon.png\" alt=\"View More\">\n                      </button>\n                    </form>\n                    <form id=\"edit\" class=\"user-options\" action=\"/accounts/edit\" method=\"POST\">\n                      <input name=\"_token\" value=\"").concat(csrfToken, "\" type=\"hidden\">\n                      <input type=\"hidden\" name=\"userid\" value=\"").concat(users[i].user_id, "\">\n                      <button type=\"submit\" class=\"button\" name=\"edit\">\n                        <img id=\"edit\" src=\"https://staging.greyareasolutions.net/images/edit.png\" alt=\"Edit\">\n                      </button>\n                    </form>\n                    <form id=\"remove\" class=\"user-options\" action=\"/accounts/remove\" method=\"POST\">\n                      <input name=\"_token\" value=\"").concat(csrfToken, "\" type=\"hidden\">\n                      <input type=\"hidden\" name=\"userid\" value=\"").concat(users[i].user_id, "\">\n                      <button type=\"submit\" class=\"button\" name=\"remove\">\n                        <img id=\"remove\" src=\"https://staging.greyareasolutions.net/images/rubbish.png\" alt=\"remove\">\n                      </button>\n                    </form>\n                  </div>\n                </td>\n              </tr>");

      // Append the row to the table.
      tableBody.append(rowHtml);
    }
  }
});
/******/ })()
;