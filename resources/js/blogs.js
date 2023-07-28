"use strict";

/*---- Constant Elements ----*/
const togglerElement = document.getElementById('toggler');
const navigationElement = document.getElementById('navigation');
const scrollerElement = document.getElementById('scroller');
const footerElement = document.querySelector('footer');
const blackoutElement = document.createElement('div');
const loginElement = document.querySelector('a#login');

/*---- Other Constants ----*/
const widthBreakPoint = 541;

/*---- Script Launch Functions ----*/
if(window.innerWidth <= widthBreakPoint) {
  footerElement.removeChild(loginElement);
  navigationElement.appendChild(loginElement);
}

/*---- Event Handlers ----*/
togglerElement.addEventListener('click', (event) => {
  if(navigationElement.classList.contains('open')) {
    navigationElement.classList.remove('open');
    footerElement.removeChild(blackoutElement);
  } else {
    navigationElement.classList.add('open');
    blackoutElement.classList.add('open');
    footerElement.appendChild(blackoutElement);
  }
});

document.addEventListener('scroll', (event) => {
  if(window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
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
  if(window.innerWidth > widthBreakPoint) {
    // Ensure that if screen width is increased, remove burger.
    navigationElement.classList.remove('open');

    if(footerElement.querySelector('div') !== null) {
      footerElement.removeChild(blackoutElement);
    }

    // Ensure that if the screen width is more than widthBreakPoint, the login button is placed in footer.
    if(navigationElement.querySelector('a#login') !== null) {
      footerElement.appendChild(loginElement);
    }
  } else {
    // Ensure that if the screen width is less than widthBreakPoint, the login button is placed in nav.
    if(navigationElement.querySelector('a#login') === null) {
      footerElement.removeChild(loginElement);
      navigationElement.appendChild(loginElement);
    }
  }
});
