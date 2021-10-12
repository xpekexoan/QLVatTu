@extends('master')
@section('title')
Chỉnh sửa phiếu đề nghị mua văn phòng phẩm
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('phieumua') }}
@endsection
@section('content')
<div class="row clearfix" id="TTTK">
  <div class="col-md-5">
    <div class="card">
      <div class="header">
        <h2>Thêm văn phòng phẩm</h2>
      </div>
      <div class="body">
        <div class="col-12">
          <label for="">Chọn văn phòng phẩm</label>
          <div class="form-group">
            <div class="form-line">
              <select class="form-control dsvanphongpham" title="Chọn 1 văn phòng phẩm" data-live-search="true" name="MaVPP" required>
              </select>
            </div>
          </div>
        </div>
        <div class="col-12">
          <label for="">Số lượng</label>
          <div class="input-group">
            <div class="form-line">
              <input type="number" id="SoLuong" min="" max="" class="form-control" placeholder="Nhập số lượng muốn mua">
            </div>
            <span class="input-group-addon" id="DonVi">Hộp</span>
          </div>
          <em>Hạn mức còn lại: <span id="txtConLai"></span>&nbsp;<span id="txtDonVi"></span>.</em>
          <a href="" style="text-decoration: underline;">Tăng hạn mức</a> <br />
        </div><br><br>
        <div style="text-align: right; clear: both;">
          <button type="button" id="btn-them" class="btn bg-blue waves-effect" disabled>
            <i class="material-icons">add</i>
            <span>Thêm</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <!-- Hover Rows -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header row">
            <h2 style="margin-left: 20px;">Danh sách đã chọn</h2>
          </div>
          <div class="body table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Mã VPP</th>
                  <th>Tên văn phòng phẩm</th>
                  <th>Đơn vị tính</th>
                  <th>Số lượng</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="DSTB">
                <tr style="display:none">
                  <td>-1</td>
                </tr>
                @foreach ($phieu->chiTietMua as $item)
                <tr id="VPP-{{ $item->VatTu->ID }}">
                  <td style="vertical-align: middle;">{{ $item->VatTu->ID }}</td>
                  <td style="vertical-align: middle;">{{ $item->VatTu->Ten }}</td>
                  <td style="vertical-align: middle;">{{ $item->VatTu->DonViTinh }}</td>
                  <td style="vertical-align: middle;">{{ $item->SoLuong }}</td>
                  <td style="vertical-align: middle;">
                    <button class="btn btn-default waves-effect XoaTB" data-id="{{ $item->VatTu->ID }}" 
                      data-tr="VPP-{{ $item->VatTu->ID }}">
                      <i class="material-icons">delete</i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div style="text-align: right; clear: both;">
              <a href="{{ route('phieumua.index') }}" class="btn bg-red waves-effect" style="margin-left:10px">
                <i class="material-icons">keyboard_return</i>
                <span>Trở lại</span>
              </a>

              <button type="button" id="btn-edit" class="btn bg-green waves-effect">
                <i class="material-icons">save</i>
                <span>Cập nhật</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Hover Rows -->
  </div>
</div>
@endsection

@section('link_head')
<!-- Colorpicker Css -->
<link href="{{ asset('dist/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" />
<!-- Dropzone Css -->
<link href="{{ asset('dist/plugins/dropzone/dropzone.css') }}" rel="stylesheet" />
<!-- Multi Select Css -->
<link href="{{ asset('dist/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet" />
<!-- Bootstrap Spinner Css -->
<link href="{{ asset('dist/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet" />
<!-- Bootstrap Tagsinput Css -->
<link href="{{ asset('dist/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- noUISlider Css -->
<link href="{{ asset('dist/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />
<link href="{{ asset('dist/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
@endsection

@section('script')
<!-- Select Plugin Js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap Colorpicker Js -->
<script src="{{ asset('dist/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<!-- Dropzone Plugin Js -->
<script src="{{ asset('dist/plugins/dropzone/dropzone.js') }}"></script>
<!-- Input Mask Plugin Js -->
<script src="{{ asset('dist/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{ asset('dist/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<!-- Jquery Spinner Plugin Js -->
<script src="{{ asset('dist/plugins/jquery-spinner/js/jquery.spinner.js') }}"></script>
<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('dist/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- noUISlider Plugin Js -->
<script src="{{ asset('dist/plugins/nouislider/nouislider.js') }}"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{ asset('dist/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script>
  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#btn-edit').click(function() {
      var dt = [];
      $('#DSTB tr:not(:first)').each(function() {
        var idTB = $(this).find("td").eq(0).html();
        var soLuong = $(this).find("td").eq(3).html();
        dt.push({
          idTB,
          soLuong
        });
      });
      if (dt.length == 0) {
        toastr.error("Danh sách văn phòng phẩm không được trống")
      } else {
        $.ajax({
          url: `{{ route("phieumua.edit", ['ID' => $phieu->ID]) }}`,
          dataType: 'json',
          type: 'POST',
          data: {
            _method: 'PUT',
            data: dt,
            _token: '{!! csrf_token() !!}',
          },
          success: function(response) {
            console.log(response)
            swal({
              title: "Hoàn thành",
              text: "Cập nhật phiếu đề nghị thành công",
              type: "success",
              confirmButtonColor: "rgb(140, 212, 245)",
              confirmButtonText: "Ok",
              closeOnConfirm: false
            }, function () {
                location.reload()
            })
          },
          error: function() {
            toastr.error("Văn phòng phẩm vượt quá mức cho phép")
          }
        });
      }
    })

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
      var $state = $(
        '<span>' + state.text + '<br/><small>Hạn mức còn lại:' + state.hmConLai + '</small></span>'
      );
      return $state;
    }
    
    $('.dsvanphongpham').select2({
      placeholder: 'Lựa chọn 1 văn phòng phẩm',
      tags: false,
      multiple: false,
      templateResult: formatState,
      minimumInputLength: 1,
      minimumResultsForSearch: 10,
      ajax: {
        url: "{{route('vpp')}}",
        dataType: "json",
        type: "POST",
        data: function(params) {
          var data = [];
          $('#DSTB tr').each(function() {
            var idTB = $(this).find("td").eq(0).html();
            data.push(idTB);
          });
          var queryParameters = {
            q: params.term,
            selected: data,
            _token: '{{csrf_token()}}'
          }
          return queryParameters;
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                text: item.Ten,
                id: item.ID,
                hmConLai: (item.HanMucToiDa - item.HanMucDaSuDung)
              }
            })
          };
        }
      }
    });

    $(".dsvanphongpham").change(function() {
      $.ajax({
        url: '{{route("cthanmuc")}}',
        dataType: 'json',
        type: 'POST',
        data: {
          id: $(this).val(),
          _token: '{!! csrf_token() !!}',
        },
        success: function(response) {
          var conlai = response[0].HanMucToiDa - response[0].HanMucDaSuDung;
          var min = (conlai == 0) ? 0 : 1;
          var max = (conlai == 0) ? 0 : conlai;
          $("#SoLuong").attr('min', min);
          $("#SoLuong").attr('max', max);
          $("#SoLuong").val(min);
          $("#txtConLai").text(conlai);
          $("#txtDonVi").text(response[0].DonViTinh);
          $("#DonVi").text(response[0].DonViTinh);
          if (conlai > 0) {
            $("#btn-them").attr("disabled", false);
          }
        }
      });
    });
    
    $("#btn-them").click(function() {
      var id = $(".dsvanphongpham :selected").val();
      var ten = $(".dsvanphongpham :selected").text();
      var dvt = $("#DonVi").text();
      var sl = $("#SoLuong").val();
      elm = `<tr id="VPP-${id}"><td>${id}</td><td>${ten}</td><td>${dvt}</td><td>${sl}</td> 
            <td style="vertical-align: middle;">
              <button class="btn btn-default waves-effect XoaTB" data-id="${id}" data-tr="VPP-${id}" onclick="removeItem(this)">
                <i class="material-icons">delete</i>
              </button>
            </td></tr>`
      $("#DSTB tr:first").after(elm);
      $("#btn-them").attr("disabled", true);
    })

    $(".XoaTB").click(function() {
      removeItem($(this))
    })
  })

  function removeItem(elm) {
    let id = $(elm).data('tr')
    $("#" + id).remove()
  }
</script>
@endsection