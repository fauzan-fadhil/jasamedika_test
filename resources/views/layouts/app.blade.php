<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Sewa Mobil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="shrotcut icon" href="{{ asset('img/favicon.ico') }}">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset("img/wallup.jpg") }}'); background-size: cover; background-attachment: fixed;">
  <div class="login-box">
   <div class="login-logo" style="color: black;">
      @yield('page')
    </div>

    <div class="card">
      @yield('content')
    </div>

    <footer style="color: white;">
    </footer>
  </div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- page script -->

@yield('script')




@if (session('status'))
  <script>
    toastr.success("{{ Session('success') }}");
  </script>
@endif
@if (Session::has('error'))
    <script>
        toastr.error("{{ Session('error') }}");
    </script>
@endif

</body>
</html>