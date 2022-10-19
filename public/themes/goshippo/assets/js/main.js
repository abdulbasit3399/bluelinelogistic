$('#toggle-drawer').on('click', () => {
  $(document.body).toggleClass('overflow-hidden drawer--show');
});

$('#close-drawer, .overlay').on('click', () => {
  $(document.body).removeClass('overflow-hidden drawer--show');
});

$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $('#main-header').addClass('active');
  } else {
    $('#main-header').removeClass('active');
  }
});

$('#drawer .menu-toggle').on('click', e => {
  e.preventDefault();
  const submenu = e.target.parentElement.querySelector('.submenu');
  submenu.classList.toggle('show');
});

$('#drawer .submenu .back').on('click', e => {
  e.preventDefault();
  const submenu = e.target.parentElement.parentElement;
  submenu.classList.remove('show');
});

$('#main-header .nav-list .menu-toggle').on('mouseover', e => {
  $('#main-header').addClass('all-over');
  $('#main-header .nav-list .submenu').removeClass('show');
  $('.overlay').addClass('active');

  const submenu = e.target.parentElement.querySelector('.submenu');
  submenu?.classList.add('show');
});

$('#main-header').on('mouseleave', e => {
  $('#main-header').removeClass('all-over');
  $('#main-header .nav-list .submenu').removeClass('show');
  $('.overlay').removeClass('active');
});

// carousel
$(document).ready(function () {
  $('.app-carousel').slick({
    // mobileFirst: true,
    autoplay: true,
    dots: true,
    arrows: false,
    autoplaySpeed: 4000,
    centerPadding: '15px',
    centerMode: false,

    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});

$('.links-carousel').slick({
  autoplay: true,
  fade: true,
  dots: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 767,
      settings: {
        dots: false,
      },
    },
  ],
});
