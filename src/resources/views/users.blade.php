<x-base-layout title="用户管理">
    <!-- 传递给sidebar的插槽，控制菜单选中状态 -->
    <x-slot:active>users</x-slot>

    <div class="content-wrapper">
        <!-- 内容标题（页面标题） -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">用户管理</h1>
                    </div>
                </div>
            </div>
        </div>


        <!-- 主体内容 -->
        <div class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary">新建用户</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input id='search' type="text" class="form-control" placeholder="用户名/邮箱">
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-primary" onclick="getUsers()">搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table id="usersTable" class="table table-bordered table-hover" style="width:100%"></table>
                                <x-table.simplePaginate></x-table.simplePaginate>
                            </div>
                        </div>

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
        <!-- 列可见性 -->
        <script src="admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <script>
            var table;

            function getUsers(url = '/users/list/?page=1'){
                // 检索条件
                var search = $('#search').val();
                if(search.trim() != ''){
                    url += "&search="+search;
                }

                // 获取数据
                $.ajax({
                    url: url,
                    dataType:"json",
                    success: function(response) {
                        console.log(response)
                        // 刷新表格数据
                        tableRefresh(response.data)
                        // x-table.paginate中的分页处理函数
                        paginate(response,"getUsers")
                    },
                    error: function(response) {
                        alert("获取数据错误")
                    }
                })
            }

            function tableRefresh(data){
                table = $("#usersTable").DataTable({
                    "destroy": true,
                    "responsive": true,
                    "autoWidth": true,
                    "scrollX": true,
                    "searching":false,
                    // "ordering":false,
                    "order":[[5,'desc'],[0,'desc']],
                    "paging": false,
                    "info":false,
                    "processing": false,//隐藏加载提示,自行处理
                    "buttons": ["colvis"],
                    "lengthMenu": [15, 25, 50, 100],
                    "lengthChange": true, 
                    data:data,
                    deferRender: true,
                    columns: [
                        {title: "ID", data: 'id'},
                        {title: "用户名", data: 'name'},
                        {title: "邮箱", data: 'email'},
                        {title: "email_verified_at", data: 'email_verified_at',visible:false},
                        {title: "创建时间", data: 'created_at',visible:false},
                        {title: "更新时间", data: 'updated_at'},
                        {title: "手机号", data: 'telephone'},
                        {title: "操作", data: null, render(h) {
                            let str = `<button type="button" class="btn btn-danger btn-sm" onclick="delUser(${h.id})">删除</button>`
                            return str
                        },},
                    ],
                    "infoCallback": function( settings, start, end, max, total, pre ) {
                        return '显示第 '+ start +' 至 '+ end +' 行，共 '+ total +' 行'
                    }
                })
                table.buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');
            }

            window.onload = function() {
                getUsers()
            }

            function delUser(id){
                let is_delete = confirm("确认删除？")
                if(is_delete){
                    // 获取数据
                    $.ajax({
                        url: '/users/delete',
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        data:{
                            id:id,
                        },
                        dataType:"json",
                        type:"POST",
                        success: function(response) {
                            if(response.code != 0){
                                alert("删除失败")
                                return ;
                            }
                            getUsers()
                        },
                        error: function(response) {
                            alert("请求失败")
                        }
                    })
                }
            }
        </script>
    </x-slot>
</x-base-layout>
