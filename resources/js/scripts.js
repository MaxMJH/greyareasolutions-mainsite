"use strict";

/*---- Constant Elements ----*/
const togglerElement = document.getElementById('toggler');
const navigationElement = document.getElementById('navigation');
const scrollerElement = document.getElementById('scroller');
const footerElement = document.querySelector('footer');
const blackoutElement = document.createElement('div');

/*---- Other Constants ----*/
const widthBreakPoint = 541;

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
    navigationElement.classList.remove('open');

    if(footerElement.querySelector('div') !== null) {
      footerElement.removeChild(blackoutElement);
    }
  }
});