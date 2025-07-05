(function () {

  "use strict";
  let ltrBtn, rtlBtn, ResetAll;
  ltrBtn = document.querySelector('#switcher-ltr');
  rtlBtn = document.querySelector('#switcher-rtl');
  ResetAll = document.querySelector('#reset-all');

  /* rtl start */
  if (rtlBtn) {
    rtlBtn.addEventListener('click', () => {
      let testimonialSwiper = document.querySelector('.testimonialSwiper');
      let homeSwiper = document.querySelector('.homeSwiper');
      if (testimonialSwiper) {
        testimonialSwiper.setAttribute("dir", "rtl");
        testimonialSwiper.classList.add('swiper-rtl');
      }
      if (homeSwiper) {
        homeSwiper.setAttribute("dir", "rtl");
        homeSwiper.classList.add('swiper-rtl');
      }
      document.querySelectorAll('.swiper-wrapper').forEach(e => e.style.transform = "translate3d(0px,0,0)")
    });
  }
  /* rtl end */

  /* ltr start */
  if (ltrBtn) {
    ltrBtn.addEventListener('click', () => {
      let testimonialSwiper = document.querySelector('.testimonialSwiper');
      let homeSwiper = document.querySelector('.homeSwiper');
      if (testimonialSwiper) {
        testimonialSwiper.setAttribute("dir", "rtl");
        testimonialSwiper.classList.add('swiper-rtl');
      }
      if (homeSwiper) {
        homeSwiper.setAttribute("dir", "rtl");
        homeSwiper.classList.add('swiper-rtl');
      }
      document.querySelectorAll('.swiper-wrapper').forEach(e => e.style.transform = "translate3d(0px,0,0)")
    });
  }
  /* ltr end */

  // reset all start
  if (ResetAll) {
    ResetAll.addEventListener('click', () => {
      let testimonialSwiper = document.querySelector('.testimonialSwiper');
      let homeSwiper = document.querySelector('.homeSwiper');
      document.querySelectorAll('.swiper-wrapper').forEach(e => e.style.transform = "translate3d(0px,0,0)")
      if (homeSwiper) {
        homeSwiper.setAttribute("dir", "ltr");
        homeSwiper.classList.remove('swiper-rtl');
      }
      if (testimonialSwiper) {
        testimonialSwiper.setAttribute("dir", "ltr");
        testimonialSwiper.classList.remove('swiper-rtl');
      }
    })
  }
  let isrtl = localStorage.getItem('hostmartl');
  if (isrtl) {
    let testimonialSwiper = document.querySelector('.testimonialSwiper');
    let homeSwiper = document.querySelector('.homeSwiper');
    if (testimonialSwiper) {
      testimonialSwiper.setAttribute("dir", "rtl");
      testimonialSwiper.classList.add('swiper-rtl');
    }
    if (homeSwiper) {
      homeSwiper.setAttribute("dir", "rtl");
      homeSwiper.classList.add('swiper-rtl');
    }
    document.querySelectorAll('.swiper-wrapper').forEach(e => e.style.transform = "translate3d(0px,0,0)")
  }
  // reset all start

  var swiper = new Swiper(".testimonialSwiper", {
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      "@0.00": {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      "@0.75": {
        slidesPerView: 2,
        spaceBetween: 20,
      },
    },
  });

  var swiper1 = new Swiper(".homeSwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
})();
