<aside id="leftsidebar" class="sidebar">
  <!-- User Info -->
  <div class="user-info">
    <div class="image">
      <img src="{{ asset('dist/images/user.png') }}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
      @if (Auth::user()->LoaiTK == 1)
      <div class="email">{{ 'Quản trị viên' }}</div>
      @else
      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->HoTen }}
      </div>
      <div class="email">{{ Auth::user()->Email }}</div>
      @endif

    </div>
  </div>
  <!-- #User Info -->
  <!-- Menu -->
  <div class="menu">
    <ul class="list">
      <li class="header">Dashboard</li>
      <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
        <a href="{{ route('index') }}">
          <i class="material-icons">home</i>
          <span>Trang chủ</span>
        </a>
      </li>
      @can('nguoidung-list')
      <li class="{{ request()->routeIs('nguoidung.*') ? 'active' : '' }}">
        <a href="{{ route('nguoidung.index') }}">
          <i class="material-icons">group</i>
          <span>Quản lý tài khoản người dùng</span>
        </a>
      </li>
      @endcan
      @can('phieumua-list')
      <li class="{{ request()->routeIs('phieumua.*') ? 'active' : '' }}">
        <a href="{{ route('phieumua.index') }}">
          <i class="material-icons">local_mall</i>
          <span>Phiếu đề nghị mua</span>
        </a>
      </li>
      @endcan
      @can('phieusua-list')
      <li class="{{ request()->routeIs('phieusua.*') ? 'active' : '' }}">
        <a href="#">
          <i class="material-icons">local_mall</i>
          <span>Phiếu đề nghị sửa</span>
        </a>
      </li>
      @endcan
      @can('phieudenghi-xetduyet')
      <li class="{{ request()->routeIs('xetduyet.*') ? 'active' : '' }}">
        <a href="{{ route('xetduyet.index') }}">
          <i class="material-icons">edit_note</i>
          <span>Xét duyệt phiếu đề nghị</span>
        </a>
      </li>
      @endcan
      @can('phieubangiao-list')
      <li class="{{ request()->routeIs('phieubangiao.*') ? 'active' : '' }}">
        <a href="{{ route('phieubangiao.index') }}">
          <i class="material-icons">topic</i>
          <span>Phiếu bàn giao</span>
        </a>
      </li>
      @endcan
      @can('hanmuc')
      <li class="{{ request()->routeIs('hanmuc.*') ? 'active' : '' }}">
        <a href="#">
          <i class="material-icons">show_chart</i>
          <span>Hạn mức</span>
        </a>
      </li>
      @endcan
      @can('vattu-list')
      <li class="{{ request()->routeIs('vattu.*') ? 'active' : '' }}">
        <a href="{{ route('vattu.index') }}">
          <i class="material-icons">handyman</i>
          <span>Vật tư</span>
        </a>
      </li>
      @endcan
      @can('thongke')
      <li class="{{ request()->routeIs('thongke') ? 'active' : '' }}">
        <a href="{{ route('thongke') }}">
          <i class="material-icons">equalizer</i>
          <span>Thống kê</span>
        </a>
      </li>
      @endcan
    </ul>
  </div>
  <!-- #Menu -->
  <!-- Footer -->
  <div class="legal">
    <div class="copyright">
      &copy; 2021 <a href="javascript:void(0);">UTE ĐÀ NẴNG</a>.
    </div>
    <div class="version">
      <b>Version: </b> 1.0
    </div>
  </div>
  <!-- #Footer -->
</aside>