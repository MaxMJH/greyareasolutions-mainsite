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
  !*** ./resources/js/modal.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);


/*---- JQuery ----*/
$(document).ready(function () {
  /*---- Constant Elements ----*/
  var staticBodyElement = $('body');

  /*---- Event Handlers ----*/
  staticBodyElement.on('click', '#panel-close', function (event) {
    event.preventDefault();
    $(this).closest('#viewPanel-modal').remove();
  });
  staticBodyElement.on('click', '#modal-cancel', function (event) {
    event.preventDefault();
    $(this).closest('#confirmation-modal').remove();
  });
  staticBodyElement.on('click', '#panel-close', function (event) {
    event.preventDefault();
    $(this).closest('#editPanel-modal').remove();
  });
});
/******/ })()
;