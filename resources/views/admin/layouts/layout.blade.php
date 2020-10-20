<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin/images/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/admin/images/favicon.png')}}">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{ config('app.name', 'Admin') }}</title>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="assets/bootstrap.min.css">
  @yield('css')
  </head>

  <body class="hold-transition sidebar-mini">

  @include('admin\layouts\haeder')

  @yield('content')

  @include('admin.layouts.footer')

<script src="{{ asset('assets/admin/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/adminlte/dist/js/demo.js') }}"></script>
<script src="{{ asset('assets/admin/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/admin/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/admin/adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/main.js') }} "></script>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/templatemo-script.js"></script>

@yield('js')

@yield('script')

</body>

</html>
