@extends('master')
@section('title')
Thống kê  
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('thongke') }}
@endsection
@section('content')
<!-- Widgets -->
<div class="row clearfix">
  <div class="col-sm-12">
    <div class="block-header" style="float: left;">
      <form action="" class="form-inline">
        <select class="form-control" name="m" id="month">
          <option value>Tháng - Tất cả</option>
          @for ($m = 1; $m <= 12; $m++)
            <option value="{{$m}}">Tháng {{$m}}</option>
          @endfor
        </select>

        <select class="form-control" name="y" id="year">
          @for ($y = now()->year; $y >= now()->year-3; $y--)
            <option value="{{$y}}">Năm {{$y}}</option>
          @endfor
        </select>

        <button class="btn btn-success">Lọc</button>
      </form>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-pink hover-expand-effect">
      <div class="icon">
        <i class="material-icons">shopping_bag</i>
      </div>
      <div class="content">
        <div class="text">Mua Văn phòng phẩm</div>
        <div class="number count-to" data-from="0" data-to="{{ $phieuMua->count() }}" data-speed="1000" 
          data-fresh-interval="20">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-cyan hover-expand-effect">
      <div class="icon">
        <i class="material-icons">handyman</i>
      </div>
      <div class="content">
        <div class="text">Sửa chữa</div>
        <div class="number count-to" data-from="0" data-to="{{ $phieuSua->count() }}" data-speed="1000" 
          data-fresh-interval="20"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-light-green hover-expand-effect">
      <div class="icon">
        <i class="material-icons">paid</i>
      </div>
      <div class="content">
        <div class="text">Chi phí mua văn phòng phẩm</div>
        <div class="number count-to" data-from="0" data-to="{{ $chiPhiMua }}" data-speed="1000" data-fresh-interval="20"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-orange hover-expand-effect">
      <div class="icon">
        <i class="material-icons">paid</i>
      </div>
      <div class="content">
        <div class="text">Chi phí sửa chữa thiết bị</div>
        <div class="number count-to" data-from="0" data-to="{{ $chiPhiSua }}" data-speed="1000" data-fresh-interval="20"></div>
      </div>
    </div>
  </div>
</div>
<!-- #END# Widgets -->


<div class="row clearfix">
  <!-- Tình hình mua sắm, sửa chữa ở các khoa, phòng ban -->
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <h2>TÌNH HÌNH MUA SẮM & SỬA CHỮA</h2>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-hover dashboard-task-infos">
            <thead>
              <tr>
                <th>#</th>
                <th>Khoa</th>
                <th>Mua sắm</th>
                <th>Sửa chữa</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($khoaPB as $item)
                <tr>
                  <td>{{ $item->ID }}</td>
                  <td>{{ $item->Ten }}</td>
                  <td>{{ $item->soLuongphieuMua(request()->get('m'), request()->get('y')) }}</td>
                  <td>{{ $item->soLuongPhieuSua(request()->get('m'), request()->get('y')) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- #END# Tình hình mua sắm các khoa, phòng ban -->

  
</div>

{{-- <div class="row clearfix">
  <!-- Mua sắm -->
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">
      <div class="body bg-cyan">
        <div class="font-bold m-b-35">MUA SẮM VĂN PHÒNG PHẨM</div>
        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)"
          data-highlight-Line-Color="#fff" data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)"
          data-spot-Color="rgb(255,255,255)" data-offset="90" data-width="100%" data-height="92px" data-line-Width="2"
          data-line-Color="rgba(255,255,255,0.7)" data-fill-Color="rgba(0, 188, 212, 0)">
          1,5,90,342,4225,8752
        </div>
        <ul class="dashboard-stat-list">
          <li>
            Hôm nay
            <span class="pull-right"><b>1</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Hôm qua
            <span class="pull-right"><b>5</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Tuần này
            <span class="pull-right"><b>90</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Học kỳ này
            <span class="pull-right"><b>342</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Năm học này
            <span class="pull-right"><b>4225</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Toàn bộ
            <span class="pull-right"><b>8752</b> <small> ĐỀ NGHỊ</small></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- #END# Mua sắm -->
  <!-- Số lượng sửa chũa -->
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">
      <div class="body bg-teal">
        <div class="font-bold m-b-35">SỬA CHỮA THIẾT BỊ VĂN PHÒNG</div>
        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)"
          data-highlight-Line-Color="#fff" data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)"
          data-spot-Color="rgb(255,255,255)" data-offset="90" data-width="100%" data-height="92px" data-line-Width="2"
          data-line-Color="rgba(255,255,255,0.7)" data-fill-Color="rgba(0, 188, 212, 0)">
          8752,5,90,342,4225,8752
        </div>
        <ul class="dashboard-stat-list">
          <li>
            Hôm nay
            <span class="pull-right"><b>8752</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Hôm qua
            <span class="pull-right"><b>5</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Tuần này
            <span class="pull-right"><b>90</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Học kỳ này
            <span class="pull-right"><b>342</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Năm học này
            <span class="pull-right"><b>4225</b> <small> ĐỀ NGHỊ</small></span>
          </li>
          <li>
            Toàn bộ
            <span class="pull-right"><b>8752</b> <small> ĐỀ NGHỊ</small></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- #END# Số lượng sửa chũa -->
</div> --}}

<!-- Các đề nghị mới nhất -->
<div class="clearfix">
  <div class="col-12">
    <div class="card">
      <div class="header">
        <h2>ĐỀ NGHỊ CHƯA DUYỆT MỚI NHẤT</h2>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-hover dashboard-task-infos">
            <thead>
              <tr>
                <th>Mã phiếu</th>
                <th>Người yêu cầu</th>
                <th>Khoa/Phòng ban</th>
                <th>Loại phiếu</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($phieuChoDuyet as $item)
                <tr>
                  <td>{{ $item->ID }}</td>
                  <td>{{ $item->nguoiDeNghi->HoTen }}</td>
                  <td>{{ $item->nguoiDeNghi->khoaPB->Ten }}</td>
                  <td>{{ $item->loaiPhieu() }}</td>
                  <td>{{ $item->trangThai() }}</td>
                  @if ($item->LoaiPhieu == 1)
                    <td>
                      <a href="{{ route('xetduyet.detail', ['ID' => $item->ID]) }}" class="btn btn-default waves-effect">
                        <i class="material-icons">visibility</i>
                      </a>
                    </td>
                  @else
                    <td>
                      <a href="#" class="btn btn-default waves-effect">
                        <i class="material-icons">visibility</i>
                      </a>
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
	<!-- Jquery Core Js -->
	
	<!-- Bổ sung vào head-->
	<!-- Morris Chart Css-->
	<link href="{{ asset('dist/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
	
	<!-- Morris Plugin Js -->
	<script src="{{ asset('dist/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('dist/plugins/morrisjs/morris.js') }}"></script>
	
	<!-- ChartJs -->
	<script src="{{ asset('dist/plugins/chartjs/Chart.bundle.js') }}"></script>
	
	<!-- Flot Charts Plugin Js -->
	<script src="{{ asset('dist/plugins/flot-charts/jquery.flot.js') }}"></script>
	<script src="{{ asset('dist/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('dist/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
	<script src="{{ asset('dist/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
	<script src="{{ asset('dist/plugins/flot-charts/jquery.flot.time.js') }}"></script>
	
	<!-- Sparkline Chart Plugin Js -->
	<script src="{{ asset('dist/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
	<!-- Jquery CountTo Plugin Js -->
	<script src="{{ asset('dist/plugins/jquery-countto/jquery.countTo.js') }}"></script>
@endsection

@section('script')
<script>
  function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
            label: 'Thành công',
            value: 70
        }, {
            label: 'Không sửa được',
            value: 30
        }],
        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
        formatter: function (y) {
            return y + '%'
        }
    });
  }
</script>
<script src="{{ asset('dist/js/pages/index.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
  $(function () {
    var start = moment().subtract(0, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    // $('#reportrange').daterangepicker({
    //     startDate: start,
    //     endDate: end,
    //     ranges: {
    //         'Hôm nay': [moment(), moment()],
    //         'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //         '7 ngày trước': [moment().subtract(6, 'days'), moment()],
    //         '30 ngày trước': [moment().subtract(29, 'days'), moment()],
    //         'Tháng này': [moment().startOf('month'), moment().endOf('month')],
    //         'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, cb);

    cb(start, end);
  });
</script>
<!-- End Script Bổ sung -->

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
<script src="{{ asset('dist/js/pages/forms/advanced-form-elements.js') }}"></script>
<script>
  $(function() {
    var m = `{{ request()->get('m') }}`
    $(`#month > option[value='${m}']`).attr('selected', 'selected')

    var y = `{{ request()->get('y') ? request()->get('y') : now()->year }}`
    $(`#year > option[value='${y}']`).attr('selected', 'selected')
    console.log($(`#year > option[value='${y}']`))
  })
</script>
@endsection