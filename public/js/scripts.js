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


/*---- Constant Elements ----*/
var togglerElement = document.getElementById('toggler');
var navigationElement = document.getElementById('navigation');
var scrollerElement = document.getElementById('scroller');
var footerElement = document.querySelector('footer');
var blackoutElement = document.createElement('div');

/*---- Other Constants ----*/
var widthBreakPoint = 541;

/*---- Event Handlers ----*/
togglerElement.addEventListener('click', function (event) {
  if (navigationElement.classList.contains('open')) {
    navigationElement.classList.remove('open');
    footerElement.removeChild(blackoutElement);
  } else {
    navigationElement.classList.add('open');
    blackoutElement.classList.add('open');
    footerElement.appendChild(blackoutElement);
  }
});
document.addEventListener('scroll', function (event) {
  if (window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    scrollerElement.classList.add('scrolled');
  } else {
    if (window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      scrollerElement.classList.remove('scrolled');
    }
  }
});
scrollerElement.addEventListener('click', function (event) {
  window.scroll(0, 0);
});
window.addEventListener('resize', function (event) {
  if (window.innerWidth > widthBreakPoint) {
    navigationElement.classList.remove('open');
    if (footerElement.querySelector('div') !== null) {
      footerElement.removeChild(blackoutElement);
    }
  }
});
/******/ })()
;