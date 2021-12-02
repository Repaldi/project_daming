<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>TOKO PROYEK DOT COM</title>
 <!-- Favicons -->
  <link href="{{asset('Gambar/Logo/favicon.png')}}" rel="icon">
  <link href="{{asset('Gambar/Logo/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('assets_dashboard/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets_dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="{{asset('assets_dashboard/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('assets_dashboard/css/argon.min-v=1.0.0.css')}}" type="text/css">
</head>

<body>
  
  <!-- Main content -->
 <div class="main-content" id="panel">

 <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                    </div>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a class="nav-link" href="{{ url('/home') }}"  aria-expanded="false">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a class="nav-link" href="{{ route('login') }}"  aria-expanded="false">Login</a>
                        </li>

                        @if (Route::has('register'))
                        <li>
                            <a class="nav-link" href="{{ route('register') }}"  aria-expanded="false">Register</a>
                        </li>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<!-- Header -->

@yield('content')

<!-- Page content -->
<div class="container-fluid mt-2">     
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
       &nbsp;
      </div>
      <div class="col-lg-6">
      <div class="copyright text-center text-lg-right text-muted">
          &copy; 2021<a href="https://tokoproyek.com" class="font-weight-bold ml-1" target="_blank">TokoProyek.Com</a>
        </div>
      </div>
    </div>
  </footer>
</div>
</div>
<!-- Argon Scripts -->
   <!-- Core -->
   <script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/lavalamp/js/jquery.lavalamp.min.js')}}"></script>
  <!-- Optional JS -->
  
  <script src="{{asset('assets_dashboard/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('assets_dashboard/vendor/chart.js/dist/Chart.extension.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('assets_dashboard/js/argon.min-v=1.0.0.js')}}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{asset('assets_dashboard/js/demo.min.js')}}"></script>

  <script>
    // Facebook Pixel Code Don't Delete
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window,
      document, 'script', '//connect.facebook.net/en_US/fbevents.js');

    try {
      fbq('init', '111649226022273');
      fbq('track', "PageView");

    } catch (err) {
      console.log('Facebook Track Error:', err);
    }
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>