"use strict";

/*---- Constant Elements ----*/
const closeElement = document.getElementById('close');

/*---- Event Handlers ----*/
// Check to see if the error / success pop up exists.
if (closeElement !== null) {
  // If so, remove the error / success message if the cross is clicked.
  closeElement.addEventListener('click', (event) => {
    event.preventDefault();
    closeElement.parentElement.remove();
  });

  // If so, remove the error / success message after ten seconds.
  closeElement.addEventListener('load', () => {
    // When removing, set opacity to so it fades out.
    setTimeout(() => {
      // Close the error / success after a second.
      setTimeout(() => {
        closeElement.parentElement.remove();
      }, 1000);
      closeElement.parentElement.style.opacity = '0';
    }, 10000);
  });
}
