@extends('master')
@section('title')
Tạo phiếu bàn giao
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieubangiao') }}
@endsection
@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header row">
                <a href="{{ route('xetduyet.index') }}" class="btn bg-orange waves-effect" style="float: left; margin-left: 10px;">
                    <i class="material-icons">add</i>
                    <span>Thêm phiếu bàn giao</span>
                </a>
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
							<th>Mã phiếu bàn giao</th>
							<th>Mã phiếu đề nghị</th>
							<th>Loại phiếu</th>
							<th>Tên người lập phiếu</th>
							<th>Ngày bàn giao</th>
							<th>Trạng thái</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $item)
							<tr>
								<th scope="row" style="vertical-align: middle;">{{ $item->ID }}</th>
								<td style="vertical-align: middle;">{{ $item->ID_PhieuDN }}</td>
								<td style="vertical-align: middle;">{{ $item->phieuDeNghi->loaiPhieu() }}</td>
								<td style="vertical-align: middle;">{{ $item->nguoiLapPhieu->HoTen }}</td>
								<td style="vertical-align: middle;">
									<abbr>{{ $item->NgayBanGiao ?? '...' }}</abbr>
								</td>
								<td style="vertical-align: middle;">
									@if (!$item->ID_NguoiXN)
										<span class="label label-warning">{{ $item->trangThai() }}</span>
									@else
										<span class="label label-success">{{ $item->trangThai() }}</span>
									@endif
								</td>
								<td style="vertical-align: middle;">
									<a href="{{ route('phieubangiao.detail', ['ID'=> $item->ID]) }}" class="btn btn-default waves-effect">
										<i class="material-icons">visibility</i>
									</a>
									@if (Auth::user()->LoaiTK == 2 && !$item->ID_NguoiXN)
										<button class="btn btn-default waves-effect" data-toggle="modal" data-target="#PhieuDeNghi4">
											<i class="material-icons">delete</i>
										</button>
										<div class="modal fade in" id="PhieuDeNghi4" tabindex="-1" role="dialog" style="display: none;">
											<div class="modal-dialog modal-sm" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Bạn có chắc chắn muốn xóa?</h4>
													</div>
													<div class="modal-body">
														Mọi thông tin về phiếu đề nghị {{ $item->ID }} sẽ biến mất hoàn toàn.
													</div>
													<div class="modal-footer">
														<form action="{{ route('phieubangiao.delete', ['ID'=>$item->ID]) }}" method="post" style="display: inline-block">
																@method('delete')
																@csrf
																<button class="btn btn-link waves-effect">
																		Tiếp tục xóa</button>
														</form>
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Hủy</button>
													</div>
												</div>
											</div>
										</div>
									@endif
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
