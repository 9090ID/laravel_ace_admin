<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Haluan TV</title>
      <link href="{{asset('/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
       <link rel="stylesheet" href="{{asset('/assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
    <!-- Custom styles for this template -->
    <link href="{{asset('/frontend/css/small-business.css')}}" rel="stylesheet">

</head>

    <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="image/LOGO.png" height="40px" width="100px">
<a  style="text-decoration: none; color:red;">Mencerdaskan dan Membangun Negeri</a></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/login') }}" target="_blank">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


        @yield('content')
   
 <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>
<script src="{{asset('/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
