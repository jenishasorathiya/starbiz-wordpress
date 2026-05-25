/***********************************************
************************************************
nav-menu
************************************************
************************************************/

(function ($) {
  "use strict";

  const BREAKPOINT = StarbizMenuSettings.breakpoint || 1024;
  function isMobile() {
    return window.innerWidth <= BREAKPOINT;
  }

  function toggleMenuMode() {
    if (window.innerWidth > BREAKPOINT) {
      document.body.classList.add('desktop-menu-mode');
      document.body.classList.remove('mobile-menu-mode');
    } else {
      document.body.classList.add('mobile-menu-mode');
      document.body.classList.remove('desktop-menu-mode');
    }
  }

  function bindMobileSubmenuToggle() {
  const $mobileMenu = $(".custom-menu-container.mobile-menu .custom-menu");
  if (!$mobileMenu.length) return;

  // Only bind to SVG inside the <a>
  $mobileMenu.find(".menu-item-has-children > a .submenu-indicator").off('click').on("click", function (e) {
    if (!document.body.classList.contains('mobile-menu-mode')) return;

    e.preventDefault(); // Prevent the link from being followed
    e.stopPropagation(); // Stop event bubbling up to <a>

    const $parent = $(this).closest(".menu-item-has-children");
    const $submenu = $parent.find("> .sub-menu");

    if ($submenu.length) {
      if (!$parent.hasClass("open")) {
        $parent.siblings(".open").removeClass("open").find("> .sub-menu").slideUp(200);

        $parent.addClass("open");
        $submenu.stop(true, true).slideDown(200);
      } else {
        $parent.removeClass("open");
        $submenu.stop(true, true).slideUp(200);
      }
    }
  });
}

  function initMenu($scope) {
    $scope.find(".custom-menu-wrapper").each(function () {
      const $wrapper = $(this);

      if ($wrapper.data("menu-init")) return;
      $wrapper.data("menu-init", true);

      const $toggle = $wrapper.find(".custom-menu-toggle");
      const $mobileContainer = $wrapper.find(".custom-menu-container.mobile-menu");
      const $mobileMenu = $mobileContainer.find(".custom-menu");
      const $iconNormal = $toggle.find(".menu-toggle-icon.normal");
      const $iconHover = $toggle.find(".menu-toggle-icon.hover");
      const $iconActive = $toggle.find(".menu-toggle-icon.active");

      function showNormalIcon() {
        $iconNormal.show();
        $iconHover.hide();
        $iconActive.hide();
      }

      function showHoverIcon() {
        $iconNormal.hide();
        $iconHover.show();
        $iconActive.hide();
      }

      function showActiveIcon() {
        $iconNormal.hide();
        $iconHover.hide();
        $iconActive.show();
      }

      function openMenu() {
        $mobileContainer.addClass("active");
        $("body").addClass("menu-open"); // ✅ prevent background scroll
        showActiveIcon();
      }

      function closeMenu() {
        $mobileContainer.removeClass("active");
        $("body").removeClass("menu-open"); // ✅ re-enable scroll
        showNormalIcon();
      }

      $toggle.on("click", function (e) {
        e.stopPropagation();
        if ($mobileContainer.hasClass("active")) {
          closeMenu();
        } else {
          openMenu();
        }
      });

      $toggle.on("mouseenter", function () {
        if (!$mobileContainer.hasClass("active")) {
          showHoverIcon();
        }
      });
      $toggle.on("mouseleave", function () {
        if (!$mobileContainer.hasClass("active")) {
          showNormalIcon();
        }
      });

      if (!isMobile()) {
        $wrapper.find(".custom-menu-container.desktop-menu .menu-item-has-children").on("mouseenter", function () {
          $(this).addClass("open").find("> .sub-menu").stop(true, true).slideDown(200);
        });
        $wrapper.find(".custom-menu-container.desktop-menu .menu-item-has-children").on("mouseleave", function () {
          $(this).removeClass("open").find("> .sub-menu").stop(true, true).slideUp(200);
        });
      }


      $(window).on("resize", function () {
        if (!isMobile()) {
          $mobileContainer.removeClass("active");
          $mobileMenu.find(".menu-item-has-children").removeClass("open").find(".sub-menu").hide();
        }

        if (isMobile()) {
          $(".custom-menu-container.desktop-menu .menu-item-has-children")
            .off("mouseenter mouseleave")
            .removeClass("open")
            .find(".sub-menu").hide();
        }
      });

      showNormalIcon();
    });
  }

  $(document).ready(function () {
    toggleMenuMode();
    bindMobileSubmenuToggle();
    initMenu($(document));
  });

  $(window).on('resize load', function () {
    toggleMenuMode();
    bindMobileSubmenuToggle();
  });

  // Elementor compatibility
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
      initMenu($scope);
    });
    elementorFrontend.hooks.addAction("frontend/element_ready/your_menu_widget.default", function ($scope) {
      initMenu($scope);
    });
  });
})(jQuery);



/***********************************************
************************************************
counter
************************************************
************************************************/

(function ($) {
    function animateCounters($scope) {
        const counters = $scope.find('.demo1-counter-number');

        if (!counters.length) return;

        // Create observer
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    let $el = $(entry.target);
                    let countTo = parseInt($el.data('count'));

                    if (!$el.hasClass('counted')) {
                        $el.addClass('counted');

                        $({ countNum: 0 }).animate(
                            { countNum: countTo },
                            {
                                duration: 3000,
                                easing: 'swing',
                                step: function () {
                                    $el.find('.demo1-counter-value').text(
                                        Math.floor(this.countNum)
                                    );
                                },
                                complete: function () {
                                    $el.find('.demo1-counter-value').text(this.countNum);
                                }
                            }
                        );
                    }

                    observer.unobserve(entry.target); // stop observing once counted
                }
            });
        }, { threshold: 0.4 }); // trigger when 40% visible

        // Observe each counter element
        counters.each(function () {
            observer.observe(this);
        });
    }

    // Elementor hook
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/counter_widget.default',
            function ($scope) {
                animateCounters($scope);
            }
        );
    });
})(jQuery);



/***********************************************
************************************************
testimonial
************************************************
************************************************/

(function ($) {
    var initTestimonialSlider = function ($scope, $) {
        const $slider = $scope.find('.demo1-testimonial-slider');
        if (!$slider.length) return;

        const navigationType = $slider.data('navigation');
        const autoplayEnabled = $slider.data('autoplay') === true || $slider.data('autoplay') === 'true';
        const autoplayDelay = parseInt($slider.data('delay')) || 3000;
        const autoplaySpeed = parseInt($slider.data('speed')) || 600;

        new Swiper($slider[0], {
            loop: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 40,
            grabCursor: true,
            speed: autoplaySpeed,
            pagination: navigationType === 'dots'
                ? {
                    el: $slider.find('.swiper-pagination')[0],
                    clickable: true,
                }
                : false,

            navigation: navigationType === 'arrows'
                ? {
                    nextEl: $slider.find('.swiper-button-next')[0],
                    prevEl: $slider.find('.swiper-button-prev')[0],
                }
                : false,
            autoplay: autoplayEnabled
                ? {
                      delay: autoplayDelay,
                      disableOnInteraction: false,
                      pauseOnMouseEnter: true,
                  }
                : false,
            breakpoints: {
                320: { slidesPerView: 1, centeredSlides: false },
                768: { slidesPerView: 'auto', centeredSlides: true },
            },
        });
    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/testimonial_slider.default', initTestimonialSlider);
    });
})(jQuery);
