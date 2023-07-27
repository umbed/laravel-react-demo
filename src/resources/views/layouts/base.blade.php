<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $attributes['title'] ?? '默认标题' }}</title>

  <!-- 离线 Google 字体: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="/AdminLTE/AdminLTE-3.x/dist/css/google.css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome 图标 -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- 载入主题样式 -->
  <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
  <!-- 自定义样式插槽 -->
  {{ $style ?? '' }}
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- 导航栏 -->
    @include('layouts.adminlte.navbar')

    <!-- 主侧边栏容器 -->
    @include('layouts.adminlte.sidebar')

    <!-- Content Wrapper. 包含页面内容 -->
    {{ $slot }}

    <!-- Control Sidebar -->
    @include('layouts.adminlte.control-sidebar')

  </div>

  <!-- jQuery -->
  <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>

  <!-- 自定义脚本插槽 -->
  {{ $script ?? '' }}
</body>

</html>