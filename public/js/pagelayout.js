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
  !*** ./resources/js/pagelayout.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);


/*---- Constant Elements ----*/
var togglerElement = document.getElementById('toggler');
var navigationElement = document.getElementById('navigation');
var scrollerElement = document.getElementById('scroller');
var headerElement = document.querySelector('header');
var blackoutElement = document.createElement('div');
var loginElement = document.querySelector('a#login');
var logoutElement = document.querySelector('form#logout');

/*---- Other Constants ----*/
// Mobile breakpoint.
var widthBreakPoint = 541;

/*---- Script Launch Functions ----*/
// When the page opens, check if the browser width is less than the mobile breakpoint.
if (window.innerWidth <= widthBreakPoint) {
  // If so, check if the login button exists in the nav bar.
  if (loginElement !== null) {
    // If so, move the login button to the mobile menu.
    headerElement.removeChild(loginElement);
    navigationElement.appendChild(loginElement);
  }

  // If so, check if the logout button exists in the nav bar.
  if (logoutElement !== null) {
    // If so, move the logout button to the mobile menu.
    headerElement.removeChild(logoutElement);
    navigationElement.appendChild(logoutElement);
  }
}

/*---- Event Handlers ----*/
// Add an event listener to the burger icon.
togglerElement.addEventListener('click', function (event) {
  // Check to see if the resized menu is already open.
  if (navigationElement.classList.contains('open')) {
    // If so, hide the menu.
    navigationElement.classList.remove('open');
    headerElement.removeChild(blackoutElement);
  } else {
    // If not, show the menu.
    navigationElement.classList.add('open');
    blackoutElement.classList.add('open');
    headerElement.appendChild(blackoutElement);
  }
});

// Add an event listener on scroll.
document.addEventListener('scroll', function (event) {
  // Check to see if the page has been scrolled past a certain point.
  if (window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    // If so, show the scroll icon.
    scrollerElement.classList.add('scrolled');
  } else {
    // Check to see if the page has been scrolled within a certain point.
    if (window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      // If so, remove the scroll icon.
      scrollerElement.classList.remove('scrolled');
    }
  }
});

// Add an event listener to the scroll icon.
scrollerElement.addEventListener('click', function (event) {
  // Return the user back to the top of the page.
  window.scroll(0, 0);
});

// Add event listener on browser resize.
window.addEventListener('resize', function (event) {
  // Check to see if the width of the browser exceeds a certain point.
  if (window.innerWidth > widthBreakPoint) {
    // If so, ensure that if screen width is increased, remove burger.
    navigationElement.classList.remove('open');

    // Ensure that if the screen width is more than widthBreakPoint, the darkened background is removed.
    if (headerElement.querySelector('div') !== null) {
      headerElement.removeChild(blackoutElement);
    }

    // Ensure that if the screen width is more than widthBreakPoint, the login button is placed in header.
    if (navigationElement.querySelector('a#login') !== null) {
      headerElement.appendChild(loginElement);
    }

    // Ensure that if the screen width is more than widthBreakPoint, the logout button is placed in header.
    if (navigationElement.querySelector('form#logout') !== null) {
      headerElement.appendChild(logoutElement);
    }
  } else {
    // Ensure that if the screen width is less than widthBreakPoint, the login button is placed in nav.
    if (loginElement !== null && navigationElement.querySelector('a#login') === null) {
      headerElement.removeChild(loginElement);
      navigationElement.appendChild(loginElement);
    }

    // Ensure that if the screen width is less than widthBreakPoint, the logout button is placed in nav.
    if (logoutElement !== null && navigationElement.querySelector('form#logout') === null) {
      headerElement.removeChild(logoutElement);
      navigationElement.appendChild(logoutElement);
    }
  }
});
/******/ })()
;