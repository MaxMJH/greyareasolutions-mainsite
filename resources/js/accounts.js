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
const widthBreakPoint = 541;

/*---- Script Launch Functions ----*/
if (window.innerWidth <= widthBreakPoint) {
  if (loginElement !== null) {
    headerElement.removeChild(loginElement);
    navigationElement.appendChild(loginElement);
  }

  if (logoutElement !== null) {
    headerElement.removeChild(logoutElement);
    navigationElement.appendChild(logoutElement);
  }
}

/*---- Event Handlers ----*/
togglerElement.addEventListener('click', (event) => {
  if (navigationElement.classList.contains('open')) {
    navigationElement.classList.remove('open');
    headerElement.removeChild(blackoutElement);
  } else {
    navigationElement.classList.add('open');
    blackoutElement.classList.add('open');
    headerElement.appendChild(blackoutElement);
  }
});

document.addEventListener('scroll', (event) => {
  if (window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    scrollerElement.classList.add('scrolled');
  } else {
    if(window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      scrollerElement.classList.remove('scrolled');
    }
  }
});

scrollerElement.addEventListener('click', (event) => {
  window.scroll(0, 0);
});

window.addEventListener('resize', (event) => {
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
