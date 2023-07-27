    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- 左侧导航栏链接 -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">主页</a>
        </li> -->
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">联系</a>
        </li> -->
      </ul>

      <!-- 右侧导航栏链接 -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
              <i class="fas fa-edit mr-2"></i>
              编辑
            </a>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          this.closest('form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i>
                {{ __('登出') }}
              </a>
            </form>
          </div>
        </li>
      </ul>
    </nav>