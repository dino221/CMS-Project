<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>@yield('title')</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/assets/css/now-ui-dashboard.css')}}"?v=1.5.0 rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('admin/assets/demo/demo.css')}}" rel="stylesheet" />
  <link href="{{ asset('css/custom.css')}}" rel="stylesheet">

</head>

<body class="">
  <div class="wrapper ">
  <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->

    <div class="sidebar" data-color="red">
      <div class="logo">
        <a href="/admin-panel" class="simple-text w-100">
          LARAVEL DINO
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ (request()->is('admin-panel')) ? 'active' : '' }}">
            <a href="/admin-panel">
              <i class="now-ui-icons design_app"></i>
              <p>Kontrolna ploča</p>
            </a>
          </li>
      @if(Auth::user()->hasAnyRole('user'))
        @else
        <li class="{{ (request()->is('admin/pages')) ? 'active' : '' }}">
              <a href="{{route('admin.pages.index')}}">
                <i class="now-ui-icons design_app"></i>
                <p>Web Stranice</p>
              </a>
            </li>
            
        @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
          <li class="menu_dropdown">
            <a data-toggle="collapse" href="#pagesExamples" class="collapsed" aria-expanded="false">
              <i class="now-ui-icons design_image"></i>
              <p>Korisnici <b class="caret"></b></p>
            </a>
            <div class="collapse show" id="pagesExamples" style="">
              <ul class="nav">
              <li  class="{{ (request()->is('admin/users')) ? 'active' : '' }}">
                <a href="{{route('admin.users.index')}}">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>Korisnici</p>
                </a>
                </li>
                <li  class="{{ (request()->is('admin/roles')) ? 'active' : '' }}">
                  <a href="{{route('admin.roles.index')}}">
                    <i class="now-ui-icons sport_user-run"></i>
                    <p>Uloge korisnika</p>
                  </a>
                  </li>
              </ul>
            </div>
          </li>
        @endif
      @endif
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Podaci</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav set-center">
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle user-dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <div class="d-flex align-center ">
                          <img class="img-fluid mr-2" src="/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px; border-radius:50%">
                          <span>{{ Auth::user()->name }}</span>
                      </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{route('admin.users.edit', Auth::user()->id)}}">
                        Uredi
                      </a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
              <li class="nav-item">
                <a alt="home" title="homepage" target="_blank" class="nav-link" href="/">
                  <i class="now-ui-icons business_globe"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Homepage</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      
      <div class="panel-header panel-header-sm">

      </div>

      <div class="content">
      @include('partials.alerts')
      @yield('content')
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
            
            </ul>
          </nav>
         
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('admin/assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <!-- Chart JS -->
  <script src="{{asset('admin/assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('admin/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('admin/assets/js/now-ui-dashboard.min.js')}}"?v=1.5.0 type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('admin/assets/demo/demo.js')}}"></script>
  @yield('scripts')
</body>

</html>