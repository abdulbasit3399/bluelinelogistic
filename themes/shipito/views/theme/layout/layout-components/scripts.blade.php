

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({
        offset: 200,
        duration: 500,
        easing: 'ease-in-quad',
        delay: 100,
        disable: 'mobile',
      });
      $('#carousel-full').carousel('pause');
      $('#carousel-mobile').carousel('pause');
      $('#carousel-popular').carousel('pause');

      function gaPopUpDisplay(lnk) {
        let popup =
          '<div class= "modal popup fade" ID = "popup" role = "dialog">' +
          '	 <div class= "modal-dialog modal-lg">' +
          '      <div class= "modal-content" ID = "popupcontent">' +
          '  	  </div>' +
          '	 </div>' +
          '	</div>';
        if (!document.getElementById('popup')) $('body').append(popup);
        let loading =
          '	   <div class= "modal-body">' +
          '	    <span>' +
          '	     <i class= "fa fa-spinner fa-spin fa-3x fa-fw"></i> ' +
          'Loading . . .' +
          '        </span>' +
          '	   </div>' +
          '	   <div class= "modal-footer">' +
          '        <button TYPE = "button" class= "btn btn-default" data-dismiss = "modal">Close</button>' +
          '	   </div>';

        $('#popupcontent').html(loading);
        $('#popup').modal({ backdrop: 'static', keyboard: false, show: true });
        $('#popupcontent').load(lnk.href, function (response, status, xhr) {
          if (status == 'error') {
            let msg = '<H1>ERROR:</H1> ';
            $('#popupcontent').html(msg + xhr.status + ' ' + xhr.statusText);
          }
        });
        return false;
      }
    </script>
    <script src="{{ asset('themes/shipito/assets/scripts/countrypicker.js') }}"></script>
    <script src="{{ asset('themes/shipito/assets/scripts/script.js') }}"></script>

    <script type="text/javascript" src="{{ asset('themes/html/assets/js/functions.js') }}"></script>
    <script src="{{ asset('themes/easyship/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();
</script>