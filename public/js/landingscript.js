/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/css/blog_editorial.css":
/*!******************************************!*\
  !*** ./resources/css/blog_editorial.css ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/accounts.css":
/*!************************************!*\
  !*** ./resources/css/accounts.css ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/edit_account_modal.css":
/*!**********************************************!*\
  !*** ./resources/css/edit_account_modal.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/view_account_modal.css":
/*!**********************************************!*\
  !*** ./resources/css/view_account_modal.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/confirmation_modal.css":
/*!**********************************************!*\
  !*** ./resources/css/confirmation_modal.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/greyareasolutions_main.css":
/*!**************************************************!*\
  !*** ./resources/css/greyareasolutions_main.css ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/login.css":
/*!*********************************!*\
  !*** ./resources/css/login.css ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/create_account.css":
/*!******************************************!*\
  !*** ./resources/css/create_account.css ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/blogs.css":
/*!*********************************!*\
  !*** ./resources/css/blogs.css ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/blog.css":
/*!********************************!*\
  !*** ./resources/css/blog.css ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/landingscript.js":
/*!***************************************!*\
  !*** ./resources/js/landingscript.js ***!
  \***************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);


/*---- Constant Elements ----*/
var togglerElement = document.getElementById('toggler');
var navigationElement = document.getElementById('navigation');
var scrollerElement = document.getElementById('scroller');
var headerElement = document.querySelector('header');
var blackoutElement = document.createElement('div');

/*---- Other Constants ----*/
// Mobile breakpoint.
var widthBreakPoint = 541;

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
    // If so, ensure that the resize menu is closed.
    navigationElement.classList.remove('open');

    // Check to see if the the blackout exists.
    if (headerElement.querySelector('div') !== null) {
      // If so, remove it.
      headerElement.removeChild(blackoutElement);
    }
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/landingscript": 0,
/******/ 			"css/blog": 0,
/******/ 			"css/blogs": 0,
/******/ 			"css/create_account": 0,
/******/ 			"css/login": 0,
/******/ 			"css/greyareasolutions_main": 0,
/******/ 			"css/confirmation_modal": 0,
/******/ 			"css/view_account_modal": 0,
/******/ 			"css/edit_account_modal": 0,
/******/ 			"css/accounts": 0,
/******/ 			"css/blog_editorial": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/js/landingscript.js")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/greyareasolutions_main.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/login.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/create_account.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/blogs.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/blog.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/blog_editorial.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/accounts.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/edit_account_modal.css")))
/******/ 	__webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/view_account_modal.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/blog","css/blogs","css/create_account","css/login","css/greyareasolutions_main","css/confirmation_modal","css/view_account_modal","css/edit_account_modal","css/accounts","css/blog_editorial"], () => (__webpack_require__("./resources/css/confirmation_modal.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;