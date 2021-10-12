@extends('master')
@section('title')
Phiếu đề nghị mua
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieumua') }}
@endsection
@section('content')
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header row">
        <a href="{{ route('phieumua.create') }}" class="btn bg-orange waves-effect" style="float: left; margin-left: 10px;">
          <i class="material-icons">add</i>
          <span>Tạo mới</span>
        </a>
        <div class="btn-group" style="margin-left: 20px;">
          <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" style="padding: 9.5px 15px;" aria-haspopup="true" aria-expanded="true">
            Tất cả <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('phieumua.search') }}" class=" waves-effect waves-block">Tất cả</a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="{{ route('phieumua.search', ['trangthai'=>1]) }}" class=" waves-effect waves-block" >Chờ duyệt</a>
            </li>
            <li>
              <a href="{{ route('phieumua.search', ['trangthai'=>2]) }}" class=" waves-effect waves-block">Chờ bàn giao</a>
            </li>
            <li>
              <a href="{{ route('phieumua.search', ['trangthai'=>3]) }}" class=" waves-effect waves-block">Hoàn thành</a>
            </li>
          </ul>
        </div>
        <div class="col-md-4" style="float:right;">
          <div class="input-group" style="margin-bottom: 0 !important;">
            <div class="form-line">
            <form action="{{ route('phieumua.search') }}" method="get">
                <input type="text" name="q" class="form-control" placeholder="Tìm kiếm">
              </form>
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
              <th>Mã Phiếu</th>
              <th>Ngày lập phiếu</th>
              <th>Ngày dự kiến hoàn thành</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <th scope="row" style="vertical-align: middle;">{{ $item->ID }}</th>
              <td style="vertical-align: middle;">{{ $item->NgayLapPhieu }}</td>
              <td style="vertical-align: middle;">{{ $item->NgayDuKien ?? '...' }}</td>
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
                @switch($item->TrangThai)
                @case(1)
                  @if ($item->GhiChu)
                    <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#MaPhieuDeNghi1">
                      <i class="material-icons">visibility</i>
                    </button>
                    <div class="modal fade" id="MaPhieuDeNghi1" tabindex="-1" role="dialog" style="display: none;">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Nội dung cần sửa đổi</h4>
                          </div>
                          <div class="modal-body">
                            <p>{{ $item->GhiChu }}</p>
                          </div>
                          <div class="modal-footer">
                            <a href="{{ route('phieumua.edit', ['ID' => $item->ID]) }}" class="btn btn-link waves-effect">Cập nhập</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  
                    <a href="{{ route('phieumua.edit', ['ID' => $item->ID]) }}" class="btn btn-default waves-effect">
                      <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-default waves-effect" data-toggle="modal" data-target="#{{ $item->ID }}">
                      <i class="material-icons">delete</i>
                    </button>
                    <div class="modal fade in" id="{{ $item->ID }}" tabindex="-1" role="dialog" style="display: none;">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Bạn có chắc chắn muốn xóa?</h4>
                          </div>
                          <div class="modal-body">
                            Mọi thông tin về phiếu đề nghị {{ $item->ID }} sẽ biến mất hoàn toàn.
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('phieumua.delete', ['ID'=>$item->ID]) }}" method="post" style="display: inline-block">
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
                  @break
                @default
                  <a href="{{ route('phieumua.detail', ['ID' => $item->ID]) }}" class="btn btn-default waves-effect">
                    <i class="material-icons">visibility</i>
                  </a>
                @endswitch
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
