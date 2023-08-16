"use strict";

/*---- Constant Elements ----*/
const closeElement = document.getElementById('close');

/*---- Event Handlers ----*/
// Check to see if the error pop up exists.
if (closeElement !== null) {
  // If so, remove the error message if the cross is clicked.
  closeElement.addEventListener('click', (event) => {
    event.preventDefault();
    closeElement.parentElement.remove();
  });

  // If so, remove the error message after ten seconds.
  closeElement.addEventListener('load', () => {
    // When removing, set opacity to so it fades out.
    setTimeout(() => {
      // Close the error after a second.
      setTimeout(() => {
        closeElement.parentElement.remove();
      }, 1000);
      closeElement.parentElement.style.opacity = '0';
    }, 10000);
  });
}
