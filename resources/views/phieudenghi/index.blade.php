@extends('master')
@section('title')
Danh sách phiếu đề nghị
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('xetduyet') }}
@endsection

@section('content')
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header row">
        <div class="btn-group" style="margin-left: 20px;">
          <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" style="padding: 9.5px 15px;"
            aria-haspopup="true" aria-expanded="true">
            Tất cả <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Tất cả</a></li>

            <li role="separator" class="divider"></li>
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Đề nghị mua</a></li>
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Đề nghị sửa</a></li>

            <li role="separator" class="divider"></li>
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Chờ duyệt</a></li>
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Chờ bàn giao</a></li>
            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Hoàn thành</a></li>
          </ul>
        </div>
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
              <th>Mã phiếu</th>
              <th>Người yêu cầu</th>
              <th>Ngày lập phiếu</th>
              <th>Loại phiếu</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <th scope="row" style="vertical-align: middle;">{{ $item->ID }}</th>
              <td style="vertical-align: middle;">{{ $item->nguoiDeNghi->HoTen }}</td>
              <td style="vertical-align: middle;">{{ $item->NgayLapPhieu }}</td>
              <td style="vertical-align: middle;">{{ $item->loaiPhieu() }}</td>
              <td style="vertical-align: middle;">
                @switch($item->TrangThai)
                  @case(1)
                    @if ($item->GhiChu)
                      <span class="label label-danger">{{ $item->trangThai() }}</span>
                    @else
                      <span class="label label-primary">{{ $item->trangThai() }}</span>
                    @endif
                    @break
                  @case(2)
                    <span class="label label-warning">
                      {{ $item->trangThai() }} ({{ $item->tongSoLuongBG().'/'.$item->tongSoLuongDN() }})
                    </span>
                    @break
                  @default
                    <span class="label label-success">{{ $item->trangThai() }}</span>
                @endswitch
              </td>
              <td style="vertical-align: middle;">
                <a href="{{ route('xetduyet.detail', ['ID'=> $item->ID]) }}" class="btn btn-default waves-effect">
                  <i class="material-icons">visibility</i>
                </a>
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