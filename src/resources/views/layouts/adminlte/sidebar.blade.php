<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- 品牌 Logo -->
  <a href="/home" class="brand-link">
    <img src="{{ asset('imgs/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <!-- <x-application-logo class="fill-current text-gray-100" style="width:30px;height:30px;color:white;" /> -->
    <span class="brand-text font-weight-light">APPNAME</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="搜索" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

    <!-- 侧边栏菜单 -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- 使用 .nav-icon 类添加图标，
               或使用 font-awesome 或其他任何图标字体库 -->
        <li class="nav-item">
          <a href="/home" class="nav-link @if(isset($active) && $active == 'home') active @endif ">
            <i class="nav-icon fas fa-home"></i>
            <p>
              主页
              <!-- <span class="right badge badge-danger">新</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/users" class="nav-link @if(isset($active) && $active == 'users') active @endif ">
            <i class="nav-icon fas fa-users"></i>
            <p>
              用户管理
            </p>
          </a>
        </li>


        <!-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              起始页
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>当前页</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>非活动页</p>
              </a>
            </li>
          </ul>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>