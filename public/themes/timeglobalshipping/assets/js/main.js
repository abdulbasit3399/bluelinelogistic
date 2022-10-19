$(".scroll-to-top").click(function () {
  $('html, body').animate({ scrollTop: 0 }, 'slow');
  return false;
});

$(window).scroll(function () {
  if ($(this).scrollTop() > 200) {
    $('.scroll-to-top').fadeIn();
  } else {
    $('.scroll-to-top').fadeOut();
  }
});

$('#industries .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: true,
  center: false,
  responsive: {
    0: {
      items: 2,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 5,
    },
  },
});

$('#our-credentials .owl-carousel').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  center: false,
  responsive: {
    0: {
      items: 2,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 4,
    },
  },
});

$('#blogs .owl-carousel').owlCarousel({
  loop: false,
  margin: 0,
  nav: false,
  center: true,
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 2,
    },
    1000: {
      items: 3,
    },
  },
});
