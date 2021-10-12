<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Đăng nhập | Hệ thống quản lí vật tư, văn phòng phẩm tại ĐH Sư phạm Kỹ thuật (UTE)</title>
  <!-- Favicon-->
  <link rel="icon" href="{{ asset('iconute.ico') }}" type="image/x-icon">

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
  
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/toastr/toastr.min.css') }}">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="login-page">
  <div class="login-box">
    <div class="logo">
      <a href="javascript:void(0);">HỆ THỐNG QUẢN LÍ VẬT TƯ</a>
      <small>Tại trường đại học Sư Phạm Kỹ Thuật - UTE</small>
    </div>
    <div class="card">
      <div class="body">
        <form action="{{ route('login') }}" id="sign_in" method="POST">
          @csrf
          @method('post')
          <div class="msg">Xin mời đăng nhập tài khoản</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line @error('TaiKhoan') error @enderror">
              <input type="text" class="form-control" name="TaiKhoan" placeholder="Tên đăng nhập" autofocus>
            </div>
            @error('TaiKhoan')
              <label class="error">
                {{ $message }}
              </label>
            @enderror
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line @error('MatKhau') error @enderror">
              <input type="password" class="form-control" name="MatKhau" placeholder="Mật khẩu">
            </div>
            @error('MatKhau')
              <label class="error">
                {{ $message }}
              </label>
            @enderror
          </div>
          <div class="row">
            <div class="col-xs-8 p-t-5">
              <input type="checkbox" name="remember" id="remember" class="filled-in chk-col-pink">
              <label for="remember">Lưu đăng nhập</label>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-block bg-pink waves-effect" type="submit">Đăng nhập</button>
            </div>
          </div>
          <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
              <a href="forgot-password.html">Quên mật khẩu</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Jquery Core Js -->
  <script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap Core Js -->
  <script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.js') }}"></script>
  <!-- Waves Effect Plugin Js -->
  <script src="{{ asset('dist/plugins/node-waves/waves.js') }}"></script>
  <!-- Custom Js -->
  <script src="{{ asset('dist/js/admin.js') }}"></script>

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