{{--  <div class="toolbar row">
    <div class="logo col-2">
        <img src="{{ asset('assets/lte/bll.png') }}" alt="" height="50px" width="100px">
    </div>
    <div class="tabs col-10">
        <ul>
            <li class="tabitem active" ><a href="#box1"><font style="color: black;">Users</font><span></span></a></li>
            <li class="tabitem" ><a href="#box1"><font style="color: black;">Good Tracking </font><span class="p-4"></span></a></li>
            <li class="tabitem " ><a href="#box1"><font style="color: black;"> Vault Tracking </font><span></span></a></li>

            <!-- <li class="tabitem"><a href="#box2"><font style="color: black;">FAVORITES</font><span></span></a></li> -->
        </ul>
    </div>
</div>  --}}




    <nav class="navbar navbar-expand-lg shadow-sm " style="background-color: rgb(223, 223, 223)">
    <div class="container"> <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('assets/lte/bll.png') }}" alt="" height="50px" width="100px">

    </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4">
    <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbar4">
    <ul class="navbar-nav mr-auto pl-lg-4">
    <li class="nav-item px-lg-2 active"> <a class="nav-link" href="{{ route('users.index') }}"> <span class="d-inline-block d-lg-none icon-width"><i class="fas fa-home"></i></span>Users</a> </li>
    <li class="nav-item px-lg-2"> <a class="nav-link" href="{{ route('shipments.goodtrack') }}"><span class="d-inline-block d-lg-none icon-width"><i class="fas fa-spa"></i></span>Good Tracking</a> </li>
    <li class="nav-item px-lg-2"> <a class="nav-link" href="{{ route('shipments.vault.index') }}"><span class="d-inline-block d-lg-none icon-width"><i class="far fa-user"></i></i></span>Vault Tracking</a> </li>

    {{--  <li class="nav-item px-lg-2 dropdown d-menu">
    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="d-inline-block d-lg-none icon-width"><i class="far fa-caret-square-down"></i></span>Dropdown
    <svg  id="arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="6 9 12 15 18 9"></polyline>
    </svg>
    </a>
    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    </div>
    </li>  --}}

    </ul>
    {{--  <ul class="navbar-nav ml-auto mt-3 mt-lg-0">
    <li class="nav-item"> <a class="nav-link" href="#">
      <i class="fab fa-twitter"></i><span class="d-lg-none ml-3">Twitter</span>
    </a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">
    <i class="fab fa-facebook"></i><span class="d-lg-none ml-3">Facebook</span>
    </a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">
    <i class="fab fa-instagram"></i><span class="d-lg-none ml-3">Instagram</span>
    </a> </li>
      <li class="nav-item"> <a class="nav-link" href="#">
    <i class="fab fa-linkedin"></i><span class="d-lg-none ml-3">Linkedin</span>
    </a> </li>
    </ul>  --}}
    </div>
    </div>
    </nav>

