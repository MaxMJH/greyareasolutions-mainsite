"use strict";

/*---- Constant Elements ----*/
const togglerElement = document.getElementById('toggler');
const navigationElement = document.getElementById('navigation');
const scrollerElement = document.getElementById('scroller');
const headerElement = document.querySelector('header');
const blackoutElement = document.createElement('div');

/*---- Other Constants ----*/
// Mobile breakpoint.
const widthBreakPoint = 541;

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
    if (window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
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
    // If so, ensure that the resize menu is closed.
    navigationElement.classList.remove('open');

    // Check to see if the the blackout exists.
    if (headerElement.querySelector('div') !== null) {
      // If so, remove it.
      headerElement.removeChild(blackoutElement);
    }
  }
});
