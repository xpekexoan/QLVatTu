@extends('master')
@section('title')
Chi tiết phiếu đề nghị mua
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieumua') }}
@endsection
@section('content')
<div class="clearfix" id="TTTK">
  <div class="col-12">
    <div class="card">
      <div class="header">
        <h2>Chi tiết phiếu đề nghị</h2>
        @if ($phieu->TrangThai == 2)
          <span class="label label-warning">
            {{ $phieu->trangThai() }} ({{ $phieu->tongSoLuongBG().'/'.$phieu->tongSoLuongDN() }})
          </span>
        @else
          <span class="label label-success">{{ $phieu->trangThai() }}</span>
        @endif
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-md-6 demo-masked-input">
            <label for="">Mã phiếu</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->ID }}</p>
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
        <div class="row clearfix">
          <div class="col-md-6 demo-masked-input">
            <label for="">Người yêu cầu</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->nguoiDeNghi->HoTen }}</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 demo-masked-input">
            <label for="">Chức vụ</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->nguoiDeNghi->vaiTro() }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-6 demo-masked-input">
            <label for="">Người xét duyệt</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->nguoiXetDuyet->HoTen }}</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 demo-masked-input">
            <label for="">Ngày lập phiếu</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->NgayLapPhieu }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-6 demo-masked-input">
            <label for="">Ngày dự kiến hoàn thành</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->NgayDuKien }}</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 demo-masked-input">
            <label for="">Đơn vị</label>
            <div class="input-group">
              <div class="form-line">
                <p>{{ $phieu->nguoiDeNghi->khoaPB->Ten }}</p>
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
            <h2 style="margin-left: 20px;">Danh sách văn phòng phẩm yêu cầu</h2>
          </div>
          <div class="body table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Mã VPP</th>
                  <th>Tên văn phòng phẩm</th>
                  <th>Đơn vị tính</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Đã bàn giao</th>
                  @if ($phieu->TrangThai == 2)
                    <th>Đang bàn giao</th>
                  @endif
                </tr>
              </thead>
              <tbody id="DSTB">
                @foreach ($phieu->chiTietMua as $item)
                  <tr id="{{ $item->VatTu->ID }}">
                    <td style="vertical-align: middle;">{{ $item->VatTu->ID }}</td>
                    <td style="vertical-align: middle;">{{ $item->VatTu->Ten }}</td>
                    <td style="vertical-align: middle;">{{ $item->VatTu->DonViTinh }}</td>
                    <td style="vertical-align: middle;">{{ $item->SoLuong }}</td>
                    <td style="vertical-align: middle;">{{ $item->Gia }}</td>
                    <td style="vertical-align: middle;">{{ $item->soLuongDaBG() }}</td>
                    @if ($phieu->TrangThai == 2)
                      <td style="vertical-align: middle;">{{ $item->soLuongDangBG() }}</td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Hover Rows -->
    <div style="text-align: right;">
      @if (Auth::user()->LoaiTK == 2)
        <a href="{{ route('xetduyet.index') }}" class="btn bg-teal waves-effect" style="margin: 20px 0;">
          <i class="material-icons">keyboard_return</i>
          <span>Trở lại</span>
        </a>
        <a href="#" class="btn bg-orange waves-effect" style="margin: 20px 0;">
          <i class="material-icons">add</i>
          <span>Tạo phiếu bàn giao</span>
        </a>
      @else
        <a href="{{ route('phieumua.index') }}" class="btn bg-teal waves-effect" style="margin: 20px 0;">
          <i class="material-icons">keyboard_return</i>
          <span>Trở lại</span>
        </a>
        @if ($phieu->TrangThai == 2 && $phieu->tongSoLuongBG() == $phieu->tongSoLuongDN())
          <form action="{{ route('phieumua.hoanThanh', ['ID' => $phieu->ID]) }}" method="post" style="display: inline-block">
            @method('put')
            @csrf
            <button class="btn bg-green waves-effect" style="margin: 20px 0;">
              <i class="material-icons">done</i>
              <span>Hoàn thành</span>
            </button>
          </form>
        @endif
        @if($phieu->TrangThai == 3)
          <button onclick="window.print();" class="btn bg-green waves-effect" style="margin: 20px 0;">
            <i class="material-icons">print</i>
            <span>In</span>
          </button>
        @endif

      @endif
    </div>
  </div>
</div>
@endsection
