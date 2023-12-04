(function() {
    'use strict';
  
    var goTopBtn = document.querySelector('.back_to_top');
  
    window.addEventListener('scroll', trackScroll);
    goTopBtn.addEventListener('click', backToTop);
});

    function trackScroll() {
      var scrolled = window.scrollY;
      var coords = document.documentElement.clientHeight;
  
      if (scrolled > coords) {
        goTopBtn.classList.add('back_to_top-show');
      }
      if (scrolled < coords) {
        goTopBtn.classList.remove('back_to_top-show');
      }
    }
  
    function backToTop() {
      if (window.scrollY > 0) {
        window.scrollBy(0, -80);
        setTimeout(backToTop, .75);
      }
    }  