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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-base-layout>