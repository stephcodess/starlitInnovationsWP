(function ($) {
  "use strict";

  /*===========================================
        =         On Load Function         =
    =============================================*/
  $(window).on("load", function () {
    $(".preloader").fadeOut();
    $(".best-sellers-nav").toggle();
    $(".contacts-nav").toggle();
  });

  /*===========================================
        =         Preloader         =
    =============================================*/
  if ($(".preloader").length > 0) {
    $(".preloaderCls").each(function () {
      $(this).on("click", function (e) {
        e.preventDefault();
        $(".preloader").css("display", "none");
      });
    });
  }

  $(".nav-toggle").click(function () {
    const navIsShowing = $(".mobile-nav").hasClass("show");
    $(".mobile-nav").toggleClass("show");
    if (navIsShowing) {
      $(".mobile-sub-menu").css("display", "flex");
      $(".mobile-nav").css("left", "0px");
    } else {
      $(".mobile-sub-menu").css("display", "none");
      $(".mobile-sub-menu").css("right", "-100%");
      $(".mobile-nav").css("left", "-100%");
    }
  });

  $(".mobile-nav .open-menu-btn").click(function () {
    var clickedId = $(this).attr("id");
    if (clickedId === "sellers") {
      $(".best-sellers-nav").css("display", "flex");
      $(".contacts-nav").css("display", "none");
    } else if (clickedId === "contact") {
      $(".best-sellers-nav").css("display", "none");
      $(".contacts-nav").css("display", "flex");
    }
    $(".mobile-sub-menu").css("right", "10%");
    $(".mobile-nav .nav-container").css("left", "-100%");
  });

  $(".mobile-sub-menu .mobile-close-btn").click(() => {
    $(".mobile-sub-menu").css("right", "-100%");
    $(".mobile-nav").css("right", "100%");
  });
  /*===========================================
        =         Sticky fix         =
  =============================================*/

  $(window).on("scroll", function () {
    var topPos = $(this).scrollTop();
    var header = $(".header-wrapper");
    if (topPos > 600) {
      header.addClass("sticky");
    } else {
      header.removeClass("sticky");
    }
  });
  
  /**
   * Portfolio isotope and filter
   */
  $(window).on("load", function () {
    let portfolioContainer = $(".portfolio-container");
    if (portfolioContainer.length) {
      let portfolioIsotope = new Isotope(portfolioContainer[0], {
        itemSelector: ".portfolio-item",
        layoutMode: "fitRows",
      });

      let portfolioFilters = $("#portfolio-flters li");

      portfolioFilters.on("click", function (e) {
        e.preventDefault();
        portfolioFilters.removeClass("filter-active");
        $(this).addClass("filter-active");

        portfolioIsotope.arrange({
          filter: $(this).attr("data-filter"),
        });
        portfolioIsotope.on("arrangeComplete", function () {
          AOS.refresh();
        });
      });
    }
  });

  /**
   * Initiate portfolio lightbox
   */
  const portfolioLightbox = GLightbox({
    selector: ".portfolio-lightbox",
  });

  /**
   * Portfolio details slider
   */
  new Swiper(".portfolio-details-slider", {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
  });

  $(".dropdown-header").click(function () {
    $(this).next(".dropdown-answer").slideToggle();
    $(this).next(".dropdown-content").toggle();
    var $toggle = $(this).closest(".dropdown-item").find(".toggle");
    $toggle.toggleClass("open closed");
  });

  $(".dropdown-item .toggle").click(function () {
    $(this).siblings(".column").find(".dropdown-content").toggle();
    $(this).toggleClass("open closed");
  });

  $(".nav-toggle").click(function () {
    $(this).toggleClass("active");
    $("body").css(
      "position",
      $(this).hasClass("active") ? "fixed" : "relative"
    );
  });
  $(".mobile-nav .open-menu-btn").click(function () {
    var clickedId = $(this).attr("id");
    var icon = $(this).find("i");

    if (clickedId === "sellers") {
      $(".best-sellers-nav").toggle();
      icon.toggleClass("rotate");
    } else if (clickedId === "contact") {
      $(".contacts-nav").toggle();
      icon.toggleClass("rotate");
    }
  });

  /**
   * Testimonials slider
   */
  new Swiper(".testimonials-slider", {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    slidesPerView: "auto",
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },

      1200: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  /*===========================================
        =         Scroll To Top         =
    =============================================*/
  // progressAvtivation
  if ($(".scroll-top").length) {
    var scrollTopbtn = $(".scroll-top");
    var progressPath = $(".scroll-top path")[0];
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 750;
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > offset) {
        scrollTopbtn.addClass("show");
      } else {
        scrollTopbtn.removeClass("show");
      }
    });
    scrollTopbtn.on("click", function (event) {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, duration);
      return false;
    });
  }
})(jQuery);
