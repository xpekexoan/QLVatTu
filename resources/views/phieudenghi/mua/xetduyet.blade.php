@extends('master')
@section('title')
Chi tiết phiếu đề nghị mua
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieumua') }}
@endsection
@section('content')
<!-- Main -->
<div class="clearfix" id="TTTK">
  <div class="col-12">
    <div class="card">
      <div class="header">
        <h2>Chi tiết phiếu đề nghị</h2>
        @switch($phieu->TrangThai)
          @case(1)
            @if ($phieu->GhiChu)
              <span class="label label-danger">{{ $phieu->trangThai() }}</span>
            @else
              <span class="label label-primary">{{ $phieu->trangThai() }}</span>
            @endif
            @break
          @case(2)
            <span class="label label-warning">
              {{ $phieu->trangThai() }} ({{ $phieu->tongSoLuongBG().'/'.$phieu->tongSoLuongDN() }})
            </span>
            @break
          @default
            <span class="label label-success">{{ $phieu->trangThai() }}</span>
        @endswitch
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
                    <label for="">Ngày yêu cầu</label>
                    <div class="input-group">
                        <div class="form-line">
                            <p>{{ $phieu->NgayLapPhieu }}</p>
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

            @if ($phieu->TrangThai != 1)
              <div class="row clearfix">
                <div class="col-md-6 demo-masked-input">
                    <label for="">Ngày hoàn thành dự kiến</label>
                    <div class="input-group">
                        <div class="form-line">
                            <p>{{ $phieu->NgayDuKien }}</p>
                        </div>
                    </div>
                </div>
              </div>
            @endif
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
                  @if ($phieu->TrangThai != 1)
                    <th>Đã bàn giao</th>
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
                    @if ($phieu->TrangThai == 1)
                      <td style="vertical-align: middle;">
                        <div class="form-line">
                          <input type="number" class="form-control" name="Gia" data-id="{{ $item->VatTu->ID }}" style="width: 35%" 
                            required>
                        </div>
                      </td>
                    @else
                      <td style="vertical-align: middle;">{{ $item->Gia }}</td>
                      <td style="vertical-align: middle;">
                        {{ $item->soLuongDaBG() }}
                      </td>
                      <td style="vertical-align: middle;">
                        {{ $item->soLuongDangBG() }}
                      </td>
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
    {{-- Kiểm tra nếu phiếu có ghi chú --}}
    @if (!!$phieu->GhiChu)
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header row">
              <h2 style="margin-left: 20px;">Phản hồi đến người đề nghị</h2>
            </div>
            <div class="body table-responsive">
              <div class="form-line">
                <textarea rows="4" id="NoiDungGhiChu" class="form-control no-resize"
                  placeholder="Nội dung cần phản hồi cho người đề nghị..." readonly>{{ $phieu->GhiChu }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <div style="text-align: right;">
      <a href="{{ route('xetduyet.index') }}" class="btn bg-teal waves-effect" style="margin: 20px 0;">
        <i class="material-icons">keyboard_return</i>
        <span>Trở lại</span>
      </a>
      {{-- Kiểm tra nếu phiếu có ghi chú và chưa duyệt --}}
      @if (!$phieu->GhiChu && $phieu->TrangThai == 1)
        <a href="#" class="btn bg-orange waves-effect" style="margin: 20px 0;" data-toggle="modal"
          data-target="#PhanHoiModel">
          <i class="material-icons">feedback</i>
          <span>Phản hồi</span>
        </a>
        <div class="modal fade in" id="PhanHoiModel" tabindex="-1" role="dialog" style="display: none;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" style="text-align: left;">Nội dung phản hồi</h4>
              </div>
              <div class="modal-body">
                <div class="form-line">
                  <textarea rows="4" id="GhiChu" class="form-control no-resize"
                    placeholder="Nội dung cần phản hồi cho người đề nghị..."></textarea>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" id="btn-phanhoi" class="btn btn-link waves-effect">Gửi</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Hủy</button>
              </div>
            </div>
          </div>
        </div>
      @endif

      {{-- Kiểm tra nếu phiếu chưa duyệt --}}
      @switch($phieu->TrangThai)
        @case(1)
          <a data-toggle="modal" data-target="#PheDuyet" class="btn bg-green waves-effect" style="margin: 20px 0;">
            <i class="material-icons">done</i>
            <span>Phê duyệt</span>
          </a>
          <div class="modal fade in" id="PheDuyet" tabindex="-1" role="dialog" style="display: none;text-align: left;">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Phê duyệt phiếu đề nghị</h4>
                </div>
                <div class="modal-body">
                  <div class="col-12 demo-masked-input">
                    <label for="">Điền ngày dự kiến hoàn thành</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                      </span>
                      <div class="form-line">
                        <input type="date" class="form-control date" name="NgayDuKien" placeholder="Ex: 30/07/2016"
                          required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <a id="btn-pheduyet" class="btn btn-link waves-effect">Phê duyệt</a>
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Hủy</button>
                </div>
              </div>
            </div>
          </div>
          @break
        @case(2)
          @if ($phieu->tongSoLuongBG() < $phieu->tongSoLuongDN())
            <a href="{{ route('phieubangiao.create' , ['ID' => $phieu->ID]) }}" class="btn bg-orange waves-effect" style="margin: 20px 0;">
              <i class="material-icons">add</i>
              <span>Tạo phiếu bàn giao</span>
            </a>
          @endif
          @break
        @default
          <button onclick="window.print();" class="btn bg-green waves-effect" style="margin: 20px 0;">
            <i class="material-icons">print</i>
            <span>In</span>
          </button>
      @endswitch
    </div>
  </div>
</div>
<!-- #END# Main -->
@endsection

@section('script')
<script>
  $(function() {
    $("#btn-phanhoi").click(function () {
      var ghiChu = $('textarea#GhiChu').val()
      if (!ghiChu) {
        toastr.error("Chưa điền nội dung phản hồi")
      } else {
        $.ajax({
          url: `{{ route('xetduyet.ghiChu', ['ID' => $phieu->ID]) }}`,
          type: 'post',
          dataType : "json",
          data: {
            _method: 'put',
            _token: $('meta[name=csrf-token]').attr('content'),
            GhiChu: ghiChu
          },
          success: function(result) {
            console.log(result)
            swal({
                title: "Hoàn thành",
                text: "Gửi phản hồi thành công",
                type: "success",
                confirmButtonColor: "rgb(140, 212, 245)",
                confirmButtonText: "Ok",
                closeOnConfirm: false
            }, function () {
                location.reload()
            })
          },
          error: function(error) {
            toastr.error("Gửi phản hồi thất bại")
          }
        })
      }
    })

    $("#btn-pheduyet").click(function () {
      var [flag, data] = getData()
      var ngayDuKien = $('input[name=NgayDuKien]').val()
      if (flag == false) {
        toastr.error("Giá chưa hợp lệ")
        return;
      }
      if (!ngayDuKien) {
        toastr.error("Ngày dự kiến không để trống")
        return;
      }
      $.ajax({
        url: `{{ route('xetduyet.confirm', ['ID' => $phieu->ID]) }}`,
        type: 'post',
        dataType : "json",
        data: {
          _method: 'put',
          _token: $('meta[name=csrf-token]').attr('content'),
          vattu: data,
          NgayDuKien: ngayDuKien
        },
        success: function(result) {
          console.log(result)
          swal({
              title: "Hoàn thành",
              text: "Xử lý phiếu thành công",
              type: "success",
              confirmButtonColor: "rgb(140, 212, 245)",
              confirmButtonText: "Ok",
              closeOnConfirm: false
          }, function () {
              location.reload()
          })
        },
        error: function(error) {
          toastr.error("Xử lý duyệt thất bại")
        }
      })
    })
  })
  
  function getData() {
    var data = []
    var flag = true
    $('input[name=Gia]').each(function(e) {
      var gia = $(this).val();
      if(!gia || gia <= 1000 || !Number.isInteger(Number(gia))) {
        flag = false
      } 
      item = {
        ID_VatTu: $(this).data('id'),
        Gia: gia
      }
      data.push(item)
    })
    return [flag, data]
  }
</script>

@endsection
