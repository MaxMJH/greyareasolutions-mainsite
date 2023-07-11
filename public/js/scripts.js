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
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);


var scrollerElement = document.getElementById('scroller');
document.addEventListener('scroll', function (event) {
  if (window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    scrollerElement.classList.toggle('scrolled');
  } else {
    if (window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      scrollerElement.classList.toggle('scrolled');
    }
  }
});
document.getElementById('scroller').addEventListener('click', function (event) {
  window.scroll(0, 0);
});
/******/ })()
;