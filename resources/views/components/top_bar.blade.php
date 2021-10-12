<nav class="navbar top-bar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="javascript:void(0);" class="bars"></a>
      <a class="navbar-brand" href="/">UTE ADMIN - HỆ THỐNG QUẢN LÍ VẬT TƯ</a>
    </div>
    <div class="flex-grow"></div>
    <div>
      <ul class="nav navbar-nav navbar-right">
        <!-- Call Search -->
        <li>
          <a href="javascript:void(0);" class="js-search" data-close="true">
            <i class="material-icons">search</i>
          </a>
        </li>
        <li>
          <div class="user-info">
            <div class="image">
              <div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('dist/images/user.png') }}" width="48" height="48" alt="User"/>
              </div>
              <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('profile.index') }}"><i class="material-icons">person</i>Thông tin cá nhân</a></li>
                <li role="seperator" class="divider"></li>
                <li><a href="{{ route('logout') }}"><i class="material-icons">input</i>Đăng xuất</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>