  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:dino.bosilj@gmail.com">dino.bosilj@gmail.com</a>
        <i class="icofont-phone"></i> +385 (0)98/955-4810
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="{{route('app.index')}}">DinoBosilj<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="{{route('app.index')}}" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{route('app.index')}}">Naslovna</a></li>
          @foreach($pages as $page)
            <li><a href="{{route('app.inner', [str_slug($page->slug), $page->id])}}">{{$page->title}}</a></li>
          @endforeach
          <li><a href="#">Contact</a></li>
          <li>
            <div class="flex-center position-ref full-height">
              @if (Route::has('login'))
                  <div class="top-right links d-flex">
                      @auth
                      @else
                          <a href="{{ route('login') }}">Login</a>
                          @if (Route::has('register'))
                              <a class="ml-2" href="{{ route('register') }}">Register</a>
                          @endif
                      @endauth
                  </div>
              @endif
            </div>
          </li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
