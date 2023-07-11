"use strict"

const scrollerElement = document.getElementById('scroller');

document.addEventListener('scroll', (event) => {
  if(window.scrollY >= 100 && !scrollerElement.classList.contains('scrolled')) {
    scrollerElement.classList.toggle('scrolled');
  } else {
    if(window.scrollY < 100 && scrollerElement.classList.contains('scrolled')) {
      scrollerElement.classList.toggle('scrolled');
    }
  }
});

document.getElementById('scroller').addEventListener('click', (event) => {
  window.scroll(0, 0);
});
