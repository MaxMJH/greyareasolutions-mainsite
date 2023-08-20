"use strict";

/*---- JQuery ----*/
$(document).ready(function() {
  /*---- Constant Element ----*/
  const buttonElements = $('form.user-options > button');

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
    success: function (response) {
      users = response.users;

      // Go through each user.
      for (let i = 0; i < users.length; i++) {
        // Check to see if the user in users list is the current user.
        if (users[i].user_id === response.current_user_id) {
          // If so, add a key value stating such.
          users[i].current_user = true;
          break;
        }
      }

      setupTable(users);
    }
  });

  /*---- Event Handler ----*/
  // Add event listeners to the three options.
  $('div#table').on('click', '.button', function(event) {
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

  // Add event listener to the select element.
  $('select#search-select').on('change', function() {
    // If the select has been changed, ensure that the input is set to empty.
    $('input#search-value').val('');

    // Essentially display all users.
    setupTable(users);
  });

  // Add event listener to search input element to check when a key is pressed.
  $('input#search-value').on('keyup', function() {
    // Get the value of the search select element.
    var searchCriteria = $('select#search-select').val();

    // Get the value of the search input element.
    var searchValue = $(this).val().toLowerCase().trim();

    // Check to see if the search input element's value is 'empty'.
    if (searchValue !== '') {
      // If so, start finding users that match search input value.
      // Create an empty array to store matching users.
      const matchedCriteria = new Array();

      // Check if the search select is set to 'fullname'.
      if (searchCriteria === 'fullname') {
        // If so, iterate through the users.
        for (let i = 0; i < users.length; i++) {
          // As fullname is not a key, firstname and lastname need to be concatenated to create fullname.
          const firstname = users[i]['firstname'].toLowerCase();
          const lastname = users[i]['lastname'].toLowerCase();
          const fullname = `${firstname} ${lastname}`;

          // Check to see if any part of the user's full name matches the search input.
          if (fullname.includes(searchValue)) {
            // If so, push it to the array.
            matchedCriteria.push(users[i]);
          }
        }
      } else {
        // If not, look for matches as normal.
        for (let i = 0; i < users.length; i++) {
          // Get the value found at the searchCriteria key, and turn it into a lowercase string.
          const sievedValue = ('' + users[i][searchCriteria]).toLowerCase();

          // Check to see if there is a match.
          if (sievedValue.includes(searchValue)) {
            // If so, push it to the array.
            matchedCriteria.push(users[i]);
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
      success: function (response) {
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
    const tableHeight = $('div#table').height();
    const nextBackElementHeight = $('div#table-next-back').height();
    const rowHeight = $('div#table > table > tbody > tr').height();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    var pagesNeeded = 0;
    var currentPage = 1;
    var indexStart = 0;
    var indexEnd = 0;

    // Calculate the current height of the table, and how many rows can fit.
    const permittedRows = Math.floor((tableHeight - (rowHeight + nextBackElementHeight)) / rowHeight);

    // Calculat the pages needed to show users.
    pagesNeeded = Math.ceil(users.length / permittedRows);

    // Display the total number of pages needed.
    $('span').text(`1 of ${pagesNeeded}`);

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
      $('button#back').on('click', function() {
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
          $('span').text(`${currentPage} of ${pagesNeeded}`);
        }

      });

      // Add an event listener to check if the next button is clicked.
      $('button#next').on('click', function() {
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
          $('span').text(`${currentPage} of ${pagesNeeded}`);
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
    const tableBody = $('div#table > table > tbody');

    // Before any users are added, clear the table, bar the first row.
    $('tbody > tr').not(':first').remove();

    // Iterate through each user, adding them to the table.
    for (let i = 0; i < users.length; i++) {
      let rowHtml;

      // Check to see if iterated user is current user.
      if (users[i].current_user === true) {
        // If so, only add the view-more button.
        rowHtml = `
              <tr>
                <td>${users[i].user_id}</td>
                <td>${users[i].email}</td>
                <td>${users[i].firstname} ${users[i].lastname}</td>
                <td>${users[i].role}</td>
                <td>${users[i].is_locked}</td>
                <td>
                  <div id="options">
                    <form id="view-more" class="user-options" action="/accounts/view" method="POST">
                      <input name="_token" value="${csrfToken}" type="hidden">
                      <input type="hidden" name="userid" value="${users[i].user_id}">
                      <button type="submit" class="button" name="view-more">
                        <img id="view-more" src="https://staging.greyareasolutions.net/images/viewmoreicon.png" alt="View More">
                      </button>
                    </form>
                  </div>
                </td>
              </tr>`;
      } else {
        // If not, show all buttons.
        rowHtml = `
              <tr>
                <td>${users[i].user_id}</td>
                <td>${users[i].email}</td>
                <td>${users[i].firstname} ${users[i].lastname}</td>
                <td>${users[i].role}</td>
                <td>${users[i].is_locked}</td>
                <td>
                  <div id="options">
                    <form id="view-more" class="user-options" action="/accounts/view" method="POST">
                      <input name="_token" value="${csrfToken}" type="hidden">
                      <input type="hidden" name="userid" value="${users[i].user_id}">
                      <button type="submit" class="button" name="view-more">
                        <img id="view-more" src="https://staging.greyareasolutions.net/images/viewmoreicon.png" alt="View More">
                      </button>
                    </form>
                    <form id="edit" class="user-options" action="/accounts/edit" method="POST">
                      <input name="_token" value="${csrfToken}" type="hidden">
                      <input type="hidden" name="userid" value="${users[i].user_id}">
                      <button type="submit" class="button" name="edit">
                        <img id="edit" src="https://staging.greyareasolutions.net/images/edit.png" alt="Edit">
                      </button>
                    </form>
                    <form id="remove" class="user-options" action="/accounts/remove" method="POST">
                      <input name="_token" value="${csrfToken}" type="hidden">
                      <input type="hidden" name="userid" value="${users[i].user_id}">
                      <button type="submit" class="button" name="remove">
                        <img id="remove" src="https://staging.greyareasolutions.net/images/rubbish.png" alt="remove">
                      </button>
                    </form>
                  </div>
                </td>
              </tr>`;
      }
      // Append the row to the table.
      tableBody.append(rowHtml);
    }
  }
});
