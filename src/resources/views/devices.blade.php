<x-base-layout title="设备管理">
  <x-slot:active>devices</x-slot>

    <div class="content-wrapper">
      <!-- 内容标题（页面标题） -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">设备管理</h1>
            </div>
          </div>
        </div>
      </div>


      <!-- 主体内容 -->
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-2">
                  <input id='search' type="text" class="form-control" placeholder="imei">
                </div>
                <div class="col-lg-2">
                  <button type="button" class="btn btn-primary" onclick="getDevices()">搜索</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="table" class="table table-bordered table-hover" style="width:100%"></table>
              <x-table.paginate />
              <x-modal.more />
            </div>
          </div>

        </div>
      </div>
    </div>

    <x-slot:style>
      <!-- DataTables -->
      <link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <!-- <link rel="stylesheet" href="admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
      <link rel="stylesheet" href="admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      </x-slot>

      <x-slot:script>
        <!-- DataTables  & Plugins -->
        <script src="admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="admin-lte/plugins/datatables/zh-cn.js"></script>
        <script src="admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- <script src="admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
        <!-- <script src="admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
        <script src="admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <!-- excel -->
        <script src="admin-lte/plugins/jszip/jszip.min.js"></script>
        <!-- pdf -->
        <!-- <script src="admin-lte/plugins/pdfmake/vfs_fonts.js"></script> -->
        <!-- <script src="admin-lte/plugins/pdfmake/pdfmake.min.js"></script> -->
        <!-- 打印 -->
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <!-- 列可见性 -->
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        </x-slot>

        <script>
          var table;

          function getDevices(url = '/devices/list/?page=1') {
            // 检索条件
            var search = $('#search').val();
            if (search.trim() != '') {
              url += "&search=" + search;
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
                paginate(response, "getDevices")
              },
              error: function(response) {
                alert("获取数据错误")
              }
            })
          }

          function tableRefresh(data) {
            table = $("#table").DataTable({
              "destroy": true,
              "responsive": true,
              "autoWidth": true,
              "scrollX": true,
              "searching": false,
              // "ordering":false,
              "order": [
                [0, 'desc'],
                [6, 'desc']
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
                  title: "imei",
                  data: 'imei'
                },
                {
                  title: "农机名称",
                  data: 'name'
                },
                {
                  title: "农机型号",
                  data: 'model',
                },
                {
                  title: "购机日期",
                  data: 'buy_date',
                },
                {
                  title: "经销商",
                  data: 'distributor',
                },
                {
                  title: "更新时间",
                  data: 'updated_at',
                },
                {
                  title: "地址",
                  data: 'address',
                },
                {
                  title: "省",
                  data: 'province',
                  visible: false
                },
                {
                  title: "市",
                  data: 'city',
                  visible: false
                },
                {
                  title: "区",
                  data: 'district',
                  visible: false
                },
                {
                  title: "街道",
                  data: 'street',
                  visible: false
                },

                {
                  title: "操作",
                  data: null,
                  render(h) {
                    let str = `<button type="button" class="btn btn-primary btn-sm" onclick="showMore(${h.imei})">查看更多</button>`
                    return str
                  },
                }
              ],
              "infoCallback": function(settings, start, end, max, total, pre) {
                return '显示第 ' + start + ' 至 ' + end + ' 行，共 ' + total + ' 行'
              }
            })
            table.buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
          }

          window.onload = function() {
            getDevices()
          }

          function showMore(imei) {
            // 获取数据
            $.ajax({
              url: `/devices/more/?imei=${imei}`,
              dataType: "json",
              success: function(response) {
                console.log(response)
                $('#exampleModal').modal('toggle')
                $('#modalContent').text(JSON.stringify(response))
              },
              error: function(response) {
                alert("获取数据错误")
              }
            })
          }
        </script>
</x-base-layout>