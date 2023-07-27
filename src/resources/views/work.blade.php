<x-base-layout title="作业信息">
  <!-- 传递给sidebar的插槽，控制菜单选中状态 -->
  <x-slot:active>work</x-slot>

    <div class="content-wrapper">
      <!-- 内容标题（页面标题） -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">作业信息</h1>
            </div>
          </div>
        </div>
      </div>


      <!-- 主体内容 -->
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <form>
                <div class="row">
                  <div class="col-lg-2">
                    <input id='search_imei' type="text" class="form-control" placeholder="设备号">
                  </div>
                  <div class="col-lg-2">
                    <input id='search_car' type="text" class="form-control" placeholder="车编号/车牌/车类型">
                  </div>
                  <div class="col-lg-2">
                    <input id='start_time' type="date" class="form-control" placeholder="开始时间">
                  </div>
                  <div class="col-lg-2">
                    <input id='end_time' type="date" class="form-control" placeholder="结束时间">
                  </div>
                  <div class="col-lg-2">
                    <button type="button" class="btn btn-primary" onclick="getData()">搜索</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-body">
              <table id="workTable" class="table table-bordered table-hover" style="width:100%"></table>
              <x-table.simplePaginate></x-table.simplePaginate>
            </div>
          </div>
        </div>
      </div>
    </div>

    <x-slot:style>
      <!-- DataTables -->
      <link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      </x-slot>

      <x-slot:script>
        <!-- DataTables  & Plugins -->
        <script src="admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="admin-lte/plugins/datatables/zh-cn.js"></script>
        <script src="admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <!-- excel -->
        <script src="admin-lte/plugins/jszip/jszip.min.js"></script>
        <!-- 打印 -->
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <!-- 列可见性 -->
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <script>
          var table;

          function getData(url = '/work/list/?page=1') {
            // 检索条件
            var search_imei = $('#search_imei').val();
            var search_car = $('#search_car').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();

            if (search_imei.trim() != '') {
              url += "&imei=" + search_imei;
            }
            if (search_car.trim() != '') {
              url += "&search_car=" + search_car;
            }
            if (start_time) {
              url += "&start_time=" + start_time;
            }
            if (end_time) {
              url += "&end_time=" + end_time;
            }


            // 获取数据
            $.ajax({
              url: url,
              dataType: "json",
              success: function(response) {
                console.log(response)
                // 刷新表格数据
                tableRefresh(response.data)
                // x-table.paginate中的分页处理函数
                paginate(response, "getData")
              },
              error: function(response) {
                alert("获取数据错误")
              }
            })
          }

          function tableRefresh(data) {
            table = $("#workTable").DataTable({
              "destroy": true,
              "responsive": true,
              "autoWidth": true,
              "scrollX": true,
              "searching": false,
              // "ordering":false,
              "order": [
                // [5, 'desc'],
                [0, 'desc']
              ],
              "paging": false,
              "info": false,
              "processing": false, //隐藏加载提示,自行处理
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
              "lengthMenu": [15, 25, 50, 100],
              "lengthChange": true,
              data: data,
              deferRender: true,
              columns: [{
                  title: "ID",
                  data: 'id',
                  visible: false
                },
                {
                  title: "设备号",
                  data: 'imei',
                },
                {
                  title: "车辆编号",
                  data: 'mark',
                },
                {
                  title: "车牌号",
                  data: 'plate',
                  visible: false
                },
                {
                  title: "车辆类型",
                  data: 'type',
                  visible: false
                },
                {
                  title: "地块面积",
                  data: 'land_area',
                },
                {
                  title: "作业面积",
                  data: 'work_area',
                },
                {
                  title: "有效面积",
                  data: 'valid_area',
                },
                {
                  title: "重复面积",
                  data: 'repet_area',
                },
                {
                  title: "平均深度(厘米)",
                  data: 'depth_avg',
                },
                {
                  title: "地址",
                  data: 'address'
                },
                {
                  title: "日期",
                  data: 'created_at',
                }
              ],
              "infoCallback": function(settings, start, end, max, total, pre) {
                return '显示第 ' + start + ' 至 ' + end + ' 行，共 ' + total + ' 行'
              }
            })
            table.buttons().container().appendTo('#workTable_wrapper .col-md-6:eq(0)');
          }

          function getNowDate() {
            var myDate = new Date;
            var year = myDate.getFullYear(); //获取当前年
            var mon = myDate.getMonth() + 1; //获取当前月

            var date = myDate.getDate(); //获取当前日
            var now = year + "-" + (mon < 10 ? "0" : "") + mon + "-" + (date < 10 ? "0" : "") + date
            return now;
          }

          function setSearchDate() {
            var start_time = $('#start_time').val(`${new Date().getFullYear()}-01-01`);
            var end_time = $('#end_time').val(getNowDate());
          }


          window.onload = function() {
            setSearchDate()
            getData()
          }
        </script>
        </x-slot>
</x-base-layout>