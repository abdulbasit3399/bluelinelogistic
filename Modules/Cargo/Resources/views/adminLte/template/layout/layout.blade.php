<!DOCTYPE html>
<html lang="en">
@include('cargo::adminLte.template.includes.head')
<body>

@include('cargo::adminLte.template.includes.header')
@yield('content')

    {{--  <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2 style="color: blue;">Edit User #64</h2>
                <p style="color: blue;">You can edit user info here</p>
            </div>
            <div class="card-body">
            <form>
                <div class="row">
                <div class="mb-3 col-4">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="" placeholder="Username" aria-describedby="">
                </div>

                <div class="mb-3 col-4">
                  <label for="" class="form-label">Password</label>
                  <input type="password" class="form-control" id="">
                </div>

                <div class="mb-3 col-4">
                    <label for="" class="form-label">Retype Password</label>
                    <input type="password" class="form-control" id="">
                  </div>
                </div>

                <div class="row">
                <div class="mb-3 col-4">
                    <label for="" class="form-label">Full Name</label>
                    <input type="text" class="form-control" placeholder="Full Name" id="" aria-describedby="">
                </div>
                <div class="mb-3 col-4">
                    <label for="" class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="abc@mail.com" id="" aria-describedby="">
                </div>
                <div class="mb-3 col-4">
                    <label for="" class="form-label">Type</label>
                    <input type="text" class="form-control text-muted" id="" placeholder="Vault" aria-describedby="">
                </div>
                </div>
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <button type="submit" class="btn btn-success" style="background-color: rgb(7, 199, 109);">Save</button>
              </form>
            </div>
        </div>
        <!-- <div id="box1" class="box show">
            <div class="item">
                <div class="itemhead">
                    <img src="https://polymer-tut.appspot.com/images/avatar-01.svg" width="70" height"70" />
                    <h2>Eric</h2>
                    <div class="heart">
                        <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                    </div>
                </div>
              <p>Have you heard about the Web Components revolution?</p><p>Click to tabs!</p>
            </div>
          <div class="item">
                <div class="itemhead">
                    <img src="https://polymer-tut.appspot.com/images/avatar-05.svg" width="70" height"70" />
                    <h2>Norberrt</h2>
                    <div class="heart">
                        <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                    </div>
                </div>
            <p>Decentralize! No canvas, no polymer.</p><p><strong>Needs only CSS and pure javascript!</strong></p>
            </div>
        </div>
        <div id="box2" class="box">
            <div class="item">
                <div class="itemhead">
                    <img src="https://polymer-tut.appspot.com/images/avatar-02.svg" width="70" height"70" />
                    <h2>Rob</h2>
                    <div class="heart">
                        <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                    </div>
                </div>
              <p>Loving this Polymer thing. This tab app from Polymer projects.</p>
              <p><a href="http://www.polymer-project.org/samples/tutorial/finished/index.html" target="_blank">YOU CAN SEE IT ON THIS LINK</a></p>
            </div>
        </div> -->
    </div>  --}}
</body>
{{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        if ($(window).width() > 991){
        $('.navbar-light .d-menu').hover(function () {
                $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
            }, function () {
                $(this).find('.sm-menu').first().stop(true, true).delay(120).slideUp(100);
            });
            }
        });
</script>
<script>

window.onload = function() {
    var heart = document.getElementsByClassName("heart");
    var classname = document.getElementsByClassName("tabitem");
    var boxitem = document.getElementsByClassName("box");

    var clickFunction = function(e) {
        e.preventDefault();
        var a = this.getElementsByTagName("a")[0];
        var span = this.getElementsByTagName("span")[0];
        var href = a.getAttribute("href").replace("#","");
        for(var i=0;i<boxitem.length;i++){
            boxitem[i].className =  boxitem[i].className.replace(/(?:^|\s)show(?!\S)/g, '');
        }
        document.getElementById(href).className += " show";
        for(var i=0;i<classname.length;i++){
            classname[i].className =  classname[i].className.replace(/(?:^|\s)active(?!\S)/g, '');
        }
        this.className += " active";
        span.className += 'active';
        var left = a.getBoundingClientRect().left;
        var top = a.getBoundingClientRect().top;
        var consx = (e.clientX - left);
        var consy = (e.clientY - top);
        span.style.top = consy+"px";
        span.style.left = consx+"px";
        span.className = 'clicked';
        span.addEventListener('webkitAnimationEnd', function(event){
            this.className = '';
        }, false);
    };

    for(var i=0;i<classname.length;i++){
        classname[i].addEventListener('click', clickFunction, false);
    }
    for(var i=0;i<heart.length;i++){
        heart[i].addEventListener('click', function(e) {
            var classString = this.className, nameIndex = classString.indexOf("active");
            if (nameIndex == -1) {
                classString += ' ' + "active";
            }
            else {
                classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+"active".length);
            }
            this.className = classString;

        }, false);
    }
}
</script>
<!-- jQuery -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>  --}}
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  --}}
        <!-- ChartJS -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/chart.js/Chart.min.js"></script>  --}}
        <!-- Sparkline -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/sparklines/sparkline.js"></script>  --}}
        <!-- JQVMap -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>  --}}
        {{--  <script src="{{ asset('assets/lte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>  --}}
        <!-- jQuery Knob Chart -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>  --}}
        <!-- daterangepicker -->
        <script src="{{ asset('assets/lte') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>  --}}
        <!-- Summernote -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.js"></script>  --}}
        <!-- overlayScrollbars -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>  --}}
        <!-- bs-custom-file-input -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>  --}}
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
        <!--begin::Custom javascript-->
		<script src="{{ asset('assets/global/js/app.js') }}"></script>
		<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
@yield('scripts')
@stack('push-scripts')
</html>
