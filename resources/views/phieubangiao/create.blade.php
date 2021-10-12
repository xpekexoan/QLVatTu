@extends('master')
@section('title')
Chi tiết phiếu bàn giao
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieubangiao') }}
@endsection
@section('content')
<div class="clearfix" id="TTTK">
	<div class="col-12">
		<div class="card">
			<div class="header">
				<h2>Chi tiết phiếu bàn giao</h2>
				@if (!$phieu->ID_NguoiXN)
				  <span class="label label-warning">{{ $phieu->trangThai() }}</span>
				@else
				  <span class="label label-success">{{ $phieu->trangThai() }}</span>
				@endif
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-6 demo-masked-input">
						<label for="">Mã phiếu bàn giao</label>
						<div class="input-group">
							<div class="form-line">
								<p>{{ $newID }}</p>
							</div>
						</div>
					</div>

					<div class="col-md-6 demo-masked-input">
						<label for="">Mã phiếu đề nghị</label>
						<div class="input-group">
							<div class="form-line">
								<p><a href="#">{{ $phieu->ID }}</a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6 demo-masked-input">
						<label for="">Người lập phiếu đề nghị</label>
						<div class="input-group">
							<div class="form-line">
								<p>{{ $phieu->nguoiDeNghi->HoTen }}<br>
									<em>({{ $phieu->nguoiDeNghi->vaiTro() . ' ' . $phieu->nguoiDeNghi->khoaPB->Ten }})</em>
								</p>
							</div>
						</div>
					</div>
          <div class="col-md-6 demo-masked-input">
						<label for="">Loại phiếu</label>
						<div class="input-group">
							<div class="form-line">
								<p>{{ $phieu->loaiPhieu() }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Hover Rows -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header row">
						<h2 style="margin-left: 20px;">
							Danh sách bàn giao {{ $phieu->LoaiPhieu == 1 ? 'văn phòng phẩm'  : 'thiết bị' }}
						</h2>
					</div>
					<div class="body table-responsive">
						<table class="table table-hover">
							@if ($phieu->LoaiPhieu == 1)
							<thead>
								<tr>
									<th>Mã VPP</th>
									<th>Tên VPP</th>
									<th>Đơn vị tính</th>
									<th>Giá</th>
									<th>Số lượng</th>
									<th>Đã bàn giao</th>
									<th>Đang bàn giao</th>
								</tr>
							</thead>
							<tbody id="DSTB">
								@foreach ($phieu->chiTietMua as $item)
								<tr id="{{ $item->VatTu->ID }}">
									<td style="vertical-align: middle;">{{ $item->VatTu->ID }}</td>
									<td style="vertical-align: middle;">{{ $item->VatTu->Ten }}</td>
									<td style="vertical-align: middle;">{{ $item->VatTu->DonViTinh }}</td>
									<td style="vertical-align: middle;">{{ $item->Gia }}</td>
									<td style="vertical-align: middle;" class="sl">{{$item->SoLuong}}</td>
									<td style="vertical-align: middle;" class="slDaBG">{{ $item->soLuongDaBG($phieu->ID) }} </td>
									@if (!$phieu->ID_NguoiXN && Auth::user()->LoaiTK == 2)
										<td style="vertical-align: middle;">
											<div class="form-line">
												<input type="number" class="form-control" name="SoLuong" data-id="6" style="width: 35%"
													value="{{ $item->soLuongDangBG($phieu->ID) }}">
											</div>
										</td>
									@else
										<td>{{ $item->soLuongDangBG($phieu->ID) }}</td>
									@endif
								</tr>
								@endforeach
							</tbody>
							@else
							<thead>
								<tr>
									<th>Mã thiết bị</th>
									<th>Tên thiết bị</th>
									<th>Đơn vị tính</th>
									<th>Tình trạng sửa</th>
									<th>Chi Phí sửa</th>
									<th>Đã bàn giao</th>
									<th>Đang bàn giao</th>
								</tr>
							</thead>
							<tbody id="DSTB">
							</tbody>
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Hover Rows -->
		<div style="text-align: right;">
			<a href="{{ route('phieubangiao.index') }}" class="btn bg-teal waves-effect" style="margin: 20px 0;">
				<i class="material-icons">keyboard_return</i>
				<span>Trở lại</span>
			</a>
      <a id="btn-save" class="btn bg-green waves-effect" style="margin: 20px 0;">
        <i class="material-icons">done</i>
        <span>Cập nhật</span>
      </a>
		</div>
	</div>
</div>
<script>
	$(function() {
		$("#btn-save").click(function() {
			var flag = true
			var dt = [];
			$('#DSTB tr').each(function() {
				var ID_VatTu = $(this).find("td").eq(0).html();
				var soLuong = $(this).find("td").find('div').find('input').eq(0).val();
				var slYC = parseInt($(this).find('td.sl').text())
				var slDBG = parseInt($(this).find('td.slDaBG').text())
				if (soLuong > (slYC - slDBG)) {
					flag = false
					return;
				}
				dt.push({
						ID_VatTu,
						soLuong
				});
			});
			if (!flag) {
				toastr.error("Số lượng chưa phù hợp")
				return;
			} else {
				$.ajax({
					url: "{{ route('phieubangiao.create', ['ID' => $phieu->ID] )}}",
					dataType: 'json',
					type: 'POST',
					data: {
						_method: 'POST',
						data: dt,
						_token: '{!! csrf_token() !!}'
					},
					success: function(response) {
						console.log(response)
						swal({
							title: "Hoàn thành",
							text: "Tạo phiếu bàn giao thành công",
							type: "success",
							confirmButtonColor: "rgb(140, 212, 245)",
							confirmButtonText: "Ok",
							closeOnConfirm: false
						}, function() {
							location.href = `{{route('phieubangiao.detail')}}/${response}`;
						});
					}, error: function(err) {
						toastr.error("Tạo phiếu thất bại")
					}
				});
			}
			
		});
	})
</script>
@endsection