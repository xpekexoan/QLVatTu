@extends('master')
@section('title')
Tài khoản người dùng
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('nguoidung') }}
@endsection
@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header row">
				<button type="button" class="btn bg-orange waves-effect" style="float: left; margin-left: 10px;">
					<i class="material-icons">person_add</i>
					<span>Tạo mới</span>
				</button>
				<div class="col-md-4" style="float:right;">
					<div class="input-group" style="margin-bottom: 0 !important;">
						<div class="form-line">
							<input type="text" class="form-control" placeholder="Tìm kiếm">
						</div>
						<span class="input-group-addon">
							<i class="material-icons">search</i>
						</span>
					</div>
				</div>
			</div>
			<div class="body table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Mã Người Dùng</th>
							<th>Họ tên</th>
							<th>Email</th>
							<th>Khoa/Phòng ban</th>
							<th>Loại tài khoản</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $item)
						<tr>
							<th scope="row" style="vertical-align: middle;">{{ $item->ID }}</th>
							<td style="vertical-align: middle;">{{ $item->HoTen }}</td>
							<td style="vertical-align: middle;">{{ $item->Email }}</td>
							<td style="vertical-align: middle;">{{ $item->khoaPB->Ten }}</td>
							<td style="vertical-align: middle;">{{ $item->vaiTro() }}</td>
							<td style="vertical-align: middle;">
								<button type="button" class="btn btn-default waves-effect">
									<i class="material-icons">edit</i>
								</button>
								<button type="button" class="btn btn-default waves-effect">
									<i class="material-icons">delete</i>
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<nav style="text-align: right;">
          {{ $data->links('vendor.pagination.custom') }}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection