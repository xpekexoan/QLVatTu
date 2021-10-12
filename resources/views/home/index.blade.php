@extends('master')
@section('title')
Trang chủ
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('home') }}
@endsection
@section('content')
<div class="card">
  <div class="header">
    <h2>Trang chủ</h2>
  </div>
  <div class="body">
    <h4>Xin chào</h4>
    <p>{{ Auth::user()->HoTen }}</p>
    <p><b>Vai trò: </b><span>{{ Auth::user()->vaitro() }}</span></p>
    <p><b>Đơn vị: </b><span>{{ Auth::user()->khoaPB->Ten }}</span></p>
  </div>
</div>
@endsection