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
/*!************************************!*\
  !*** ./resources/js/errorpopup.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);


/*---- Constant Elements ----*/
var closeElement = document.getElementById('close');

/*---- Event Handlers ----*/
// Check to see if the error / success pop up exists.
if (closeElement !== null) {
  // If so, remove the error / success message if the cross is clicked.
  closeElement.addEventListener('click', function (event) {
    event.preventDefault();
    closeElement.parentElement.remove();
  });

  // If so, remove the error / success message after ten seconds.
  closeElement.addEventListener('load', function () {
    // When removing, set opacity to so it fades out.
    setTimeout(function () {
      // Close the error / success after a second.
      setTimeout(function () {
        closeElement.parentElement.remove();
      }, 1000);
      closeElement.parentElement.style.opacity = '0';
    }, 10000);
  });
}
/******/ })()
;