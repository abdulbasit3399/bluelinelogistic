$(document).ready(function (evt) {
  $('#main-nav').on('hidden.bs.collapse', function (e) {
    $('.back-to-top-link').show();
    $('.livechat_button').show();
    $('BODY').removeClass('pancake-open');
  });
  $('#main-nav').on('shown.bs.collapse', function (e) {
    $('.back-to-top-link').hide();
    $('.livechat_button').hide();
    $('BODY').addClass('pancake-open');
  });
  $('.submenu-title').click(function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    var parent = $(this).closest('.links');
    $(parent).toggleClass('expanded');
  });
  var isOS = /iPad|iPhone|iPod/.test(navigator.platform);
  if (isOS) {
    $('body').on('touchstart', function (e) {
      $('[data-toggle="tooltip"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.tooltip').has(e.target).length === 0) {
          $(this).tooltip('hide');
        }
      });
    });
  }
  $('[data-toggle="tooltip"]').tooltip({ html: true });
});
