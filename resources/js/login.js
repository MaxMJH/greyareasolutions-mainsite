"use strict";

/*---- Constant Elements ----*/
const closeElement = document.getElementById('close');

/*---- Event Handlers ----*/
if (closeElement !== null) {
  // Remove the error message if the cross is clicked.
  closeElement.addEventListener('click', (event) => {
    event.preventDefault();
    closeElement.parentElement.remove();
  });
}

if (closeElement !== null) {
  // When the page has loaded, remove the error within 10 seconds.
  closeElement.addEventListener('load', () => {
    setTimeout(() => {
      setTimeout(() => {
        closeElement.parentElement.remove();
      }, 1000);
      closeElement.parentElement.style.opacity = '0';
    }, 10000);
  });
}
