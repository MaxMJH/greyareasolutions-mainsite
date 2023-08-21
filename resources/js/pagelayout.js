"use strict";

/*---- Constant Elements ----*/
const togglerElement = document.getElementById('toggler');
const navigationElement = document.getElementById('navigation');
const scrollerElement = document.getElementById('scroller');
const headerElement = document.querySelector('header');
const blackoutElement = document.createElement('div');
const loginElement = document.querySelector('a#login');
const logoutElement = document.querySelector('form#logout');

/*---- Other Constants ----*/
// Mobile breakpoint.
const widthBreakPoint = 541;

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
togglerElement.addEventListener('click', (event) => {
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
document.addEventListener('scroll', (event) => {
  // Check to see if the page has been scrolled past a certain point.
  if (window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    // If so, show the scroll icon.
    scrollerElement.classList.add('scrolled');
  } else {
    // Check to see if the page has been scrolled within a certain point.
    if(window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      // If so, remove the scroll icon.
      scrollerElement.classList.remove('scrolled');
    }
  }
});

// Add an event listener to the scroll icon.
scrollerElement.addEventListener('click', (event) => {
  // Return the user back to the top of the page.
  window.scroll(0, 0);
});

// Add event listener on browser resize.
window.addEventListener('resize', (event) => {
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
    if(loginElement !== null && navigationElement.querySelector('a#login') === null) {
      headerElement.removeChild(loginElement);
      navigationElement.appendChild(loginElement);
    }

    // Ensure that if the screen width is less than widthBreakPoint, the logout button is placed in nav.
    if(logoutElement !== null && navigationElement.querySelector('form#logout') === null) {
      headerElement.removeChild(logoutElement);
      navigationElement.appendChild(logoutElement);
    }
  }
});
