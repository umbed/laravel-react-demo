<x-base-layout title="主页">
    <!-- 传递给sidebar的插槽，控制菜单选中状态 -->
    <x-slot:active>home</x-slot>

        <div class="content-wrapper">
            <!-- 内容标题（页面标题） -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">主页</h1>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 主体内容 -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <!-- <div class="card-header">
                        </div> -->
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">用户名: {{ Auth::user()->name }}</li>

                            @if(false)
                                @if(isset($company))
                                    <li class="list-group-item">单位: {{ $company->name }}</li>
                                    <li class="list-group-item">邀请码: {{ $company->join_code }}</li>
                                    
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-danger mb-2">退出公司</button>
                                    </li>
                            
                                @else
                                    <li class="list-group-item">
                                        <div class="form-inline">
                                            <input type="text" class="form-control mb-2 mr-sm-2" id="joinCode" placeholder="邀请码">
                                            <button type="button" class="btn btn-primary mb-2">加入单位</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-inline">
                                            <input type="text" class="form-control mb-2 mr-sm-2" id="companyName" placeholder="单位名称">
                                            <button type="button" class="btn btn-primary mb-2">创建单位</button>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>