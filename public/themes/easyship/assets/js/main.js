$('#nav-open').on('click', () => {
  $('body').addClass('drawer--show overflow-hidden');
});

$('#nav-close').on('click', () => {
  $('body').removeClass('drawer--show overflow-hidden');
});

$('.overlay').on('click', () => {
  $('body').removeClass('drawer--show overflow-hidden');
});

$('.dropdown:not(.custom) .dropdown-toggle').on('mouseover', e => {
  const drp = e.target.parentElement;
  drp.addEventListener('mouseleave', event => {
    event.target.querySelector('.dropdown-menu')?.classList.remove('show');
  });
  const menu = drp.querySelector('.dropdown-menu');
  menu?.classList.add('show');
});

// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function (e) {
  if (e.target.nextElementSibling?.classList.contains('submenu')) e.stopPropagation();
  else {
    console.log(e.target.parentElement.parentElement?.classList.remove('show'));
  }
});
