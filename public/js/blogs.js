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
  !*** ./resources/js/blogs.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);


/*---- Constant Elements ----*/
var togglerElement = document.getElementById('toggler');
var navigationElement = document.getElementById('navigation');
var scrollerElement = document.getElementById('scroller');
var headerElement = document.querySelector('header');
var blackoutElement = document.createElement('div');
var loginElement = document.querySelector('a#login');

/*---- Other Constants ----*/
var widthBreakPoint = 541;

/*---- Script Launch Functions ----*/
if (window.innerWidth <= widthBreakPoint) {
  headerElement.removeChild(loginElement);
  navigationElement.appendChild(loginElement);
}

/*---- Event Handlers ----*/
togglerElement.addEventListener('click', function (event) {
  if (navigationElement.classList.contains('open')) {
    navigationElement.classList.remove('open');
    headerElement.removeChild(blackoutElement);
  } else {
    navigationElement.classList.add('open');
    blackoutElement.classList.add('open');
    headerElement.appendChild(blackoutElement);
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
    // Ensure that if screen width is increased, remove burger.
    navigationElement.classList.remove('open');
    if (headerElement.querySelector('div') !== null) {
      headerElement.removeChild(blackoutElement);
    }

    // Ensure that if the screen width is more than widthBreakPoint, the login button is placed in header.
    if (navigationElement.querySelector('a#login') !== null) {
      headerElement.appendChild(loginElement);
    }
  } else {
    // Ensure that if the screen width is less than widthBreakPoint, the login button is placed in nav.
    if (navigationElement.querySelector('a#login') === null) {
      headerElement.removeChild(loginElement);
      navigationElement.appendChild(loginElement);
    }
  }
});
/******/ })()
;