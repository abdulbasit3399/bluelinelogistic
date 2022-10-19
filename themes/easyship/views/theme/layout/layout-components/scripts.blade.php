{{-- Bottom script --}}
<script>
    WebFontConfig = {
        google: {
            families: ["Poppins:regular,500,600,700:latin", "Roboto:100,300,400,500,700,900:latin", "Open+Sans:400,600,700,800:latin"],
        },
    };
    (function () {
        var wf = document.createElement("script");
        wf.src = "//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
        wf.type = "text/javascript";
        wf.async = "true";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>
<script type="text/javascript" src="{{ asset('themes/html/assets/js/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/html/assets/js/sliders.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/html/custom-assets/js/app.js') }}"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();
</script>
<script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>
<script src="{{ asset('themes/easyship/assets/js/main.js') }}"></script>


