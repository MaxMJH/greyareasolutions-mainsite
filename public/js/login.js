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
/*!*******************************!*\
  !*** ./resources/js/login.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);


/*---- Constant Elements ----*/
var closeElement = document.getElementById('close');

/*---- Event Handlers ----*/
if (closeElement !== null) {
  // Remove the error message if the cross is clicked.
  closeElement.addEventListener('click', function (event) {
    event.preventDefault();
    closeElement.parentElement.remove();
  });
}
if (closeElement !== null) {
  // When the page has loaded, remove the error within 10 seconds.
  closeElement.addEventListener('load', function () {
    setTimeout(function () {
      setTimeout(function () {
        closeElement.parentElement.remove();
      }, 1000);
      closeElement.parentElement.style.opacity = '0';
    }, 10000);
  });
}
/******/ })()
;