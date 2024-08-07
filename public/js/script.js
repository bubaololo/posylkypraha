(function($) {

  "use strict";

  const tabs = document.querySelectorAll('[data-tab-target]')
  const tabContents = document.querySelectorAll('[data-tab-content]')

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = document.querySelector(tab.dataset.tabTarget)
      tabContents.forEach(tabContent => {
        tabContent.classList.remove('active')
      })
      tabs.forEach(tab => {
        tab.classList.remove('active')
      })
      tab.classList.add('active')
      target.classList.add('active')
    })
  });

  // Responsive Navigation with Button

  const hamburger = document.querySelector(".hamburger");
  const navMenu = document.querySelector(".menu-list");

  if(hamburger && navMenu) {

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("responsive");
    }

    const navLink = document.querySelectorAll(".nav-link");

    navLink.forEach(n => n.addEventListener("click", closeMenu));

    function closeMenu() {
      hamburger.classList.remove("active");
      navMenu.classList.remove("responsive");
    }

  }
  // close when click off of container
  // $(document).on('click touchstart', function (e){
  //
  //   var x = document.getElementById("navigation");
  //   if (x.className === "top-menu") {
  //     x.className += " menu-bar";
  //   } else {
  //     x.className = "top-menu";
  //   }
  //
  // });

  $(document).ready(function(){

    Chocolat(document.querySelectorAll('.image-link'), {
        imageSize: 'contain',
        loop: true,
    })


    // $('#header-wrap').on('click', '.search-toggle', function(e) {
    //   var selector = $(this).data('selector');
    //
    //   $(selector).toggleClass('show').find('.search-input').focus();
    //   $(this).toggleClass('active');
    //
    //   e.preventDefault();
    // });


    // close when click off of container
    // $(document).on('click touchstart', function (e){
    //   if (!$(e.target).is('.search-toggle, .search-toggle *, #header-wrap, #header-wrap *')) {
    //     $('.search-toggle').removeClass('active');
    //     $('#header-wrap').removeClass('show');
    //   }
    // });

    // $('.main-slider').slick({
    //     autoplay: false,
    //     autoplaySpeed: 4000,
    //     fade: true,
    //     dots: true,
    //     prevArrow: $('.prev'),
    //     nextArrow: $('.next'),
    // });

    // $('.product-grid').slick({
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     autoplay: false,
    //     autoplaySpeed: 2000,
    //     dots: true,
    //     arrows: false,
    //     responsive: [
    //       {
    //         breakpoint: 1400,
    //         settings: {
    //           slidesToShow: 3,
    //           slidesToScroll: 1
    //         }
    //       },
    //       {
    //         breakpoint: 999,
    //         settings: {
    //           slidesToShow: 2,
    //           slidesToScroll: 1
    //         }
    //       },
    //       {
    //         breakpoint: 660,
    //         settings: {
    //           slidesToShow: 1,
    //           slidesToScroll: 1
    //         }
    //       }
    //       // You can unslick at a given breakpoint now by adding:
    //       // settings: "unslick"
    //       // instead of a settings object
    //     ]
    // });

    AOS.init({
      duration: 1200,
      once: true,
    })

    jQuery('.stellarnav').stellarNav({
      theme: 'plain',
      closingDelay: 250,
      // mobileMode: false,
    });

  }); // End of a document


})(jQuery);

/* HIDING__HEADER____________________________________ */

const body = document.body;
let lastScroll = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll <= 0) {
    body.classList.remove("scroll-up");
    return;
  }

  if (currentScroll > lastScroll && !body.classList.contains("scroll-down")) {
    body.classList.remove("scroll-up");
    body.classList.add("scroll-down");
  } else if (
      currentScroll < lastScroll &&
      body.classList.contains("scroll-down")
  ) {
    body.classList.remove("scroll-down");
    body.classList.add("scroll-up");
  }
  lastScroll = currentScroll;
});
