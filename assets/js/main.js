jQuery(document).ready(function () {

  // header
  $(window).scroll(function () {
    var top = $(window).scrollTop();
    if (top >= 60) {
      $("header").addClass('secondary');
      $("header ul li ul .home").addClass('secondary');
      $(".Arrow").addClass('appear');
    } else
    if ($("header").hasClass('secondary')) {
      $("header").removeClass('secondary');
      $("header ul li ul .home").removeClass('secondary');
      $(".Arrow").removeClass('appear');
    }
  });

  $('.post-wrapper').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    infinite: true,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 868,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 914,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.test-caro').owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    nav: false,
    items: 1
  })

  // responsive navbar
  $('.icon').on('click', function () {
    $('.nav').toggleClass('show');
    $('.nav ul').toggleClass('show');
  });

});