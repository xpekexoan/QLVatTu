<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>@yield('title') | Hệ thống quản lí vật tư, văn phòng phẩm tại ĐH Sư phạm Kỹ thuật (UTE)</title>
  <!-- Favicon-->
  <link rel="icon" href="{{asset('iconute.ico')}}" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
    type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <!-- Bootstrap Core Css -->
  <link href="{{ asset('dist/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
  <!-- Waves Effect Css -->
  <link href="{{ asset('dist/plugins/node-waves/waves.css') }}" rel="stylesheet">
  <!-- Animation Css -->
  <link href="{{ asset('dist/plugins/animate-css/animate.css') }}" rel="stylesheet">
  <!-- Custom Css -->
  <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="{{ asset('dist/css/themes/all-themes.css') }}" rel="stylesheet">
  <script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/toastr/toastr.min.css') }}">

  @yield('link_head')
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <!-- Sweetalert Css -->
  <link href="{{ asset('dist/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
  <!-- SweetAlert Plugin Js -->
  <script src="{{ asset('dist/plugins/sweetalert/sweetalert.min.js') }}"></script>
</head>

<body class="theme-red">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->

  <!-- Search Bar -->
  @include('components.search_bar')
  <!-- #END# Search Bar -->

  <!-- Top Bar -->
  @include('components.top_bar')
  <!-- #Top Bar -->

  <section>
    <!-- Left Sidebar -->
    @include('components.left_sidebar')
    <!-- #END# Left Sidebar -->
  </section>

  <section class="content">
    <div class="container-fluid">
      {{-- @include('components.breadcrumb') --}}
      <ol class="breadcrumb" style="float: right;">
        @yield('breadcrumb')
      </ol>
      <br><br><br>
      <!-- Hover Rows -->
      @yield('content')
      <!-- #END# Hover Rows -->
    </div>
  </section>

  <!-- Bootstrap Core Js -->
  <script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.js') }}"></script>
  <!-- Select Plugin Js -->
  <script src="{{ asset('dist/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
  <!-- Slimscroll Plugin Js -->
  <script src="{{ asset('dist/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
  <!-- Waves Effect Plugin Js -->
  <script src="{{ asset('dist/plugins/node-waves/waves.js') }}"></script>
  @yield('script')
  <!-- Custom Js -->
  <script src="{{ asset('dist/js/admin.js') }}"></script>
  <!-- Demo Js -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>

  <script src="{{ asset('dist/plugins/toastr/toastr.min.js') }}"></script>
	@php
    if (session('alert-success'))
    {
      echo '<script>toastr.success("'.session('alert-success').'")</script>';
    }
    if (session('alert-fail'))
    {
      echo '<script>toastr.error("'.session('alert-fail').'")</script>';
    }
  @endphp
</body>

</html>
