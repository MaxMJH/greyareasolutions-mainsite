"use strict";

/*---- JQuery ----*/
$(document).ready(function() {
  /*---- Constant Elements ----*/
  const staticBodyElement = $('body');

  /*---- Event Handlers ----*/
  staticBodyElement.on('click', '#panel-close', function(event) {
    event.preventDefault();
    $(this).closest('#viewPanel-modal').remove();
  });

  staticBodyElement.on('click', '#modal-cancel', function(event) {
    event.preventDefault();
    $(this).closest('#confirmation-modal').remove();
  });

  staticBodyElement.on('click', '#panel-close', function(event) {
    event.preventDefault();
    $(this).closest('#editPanel-modal').remove();
  });
});
