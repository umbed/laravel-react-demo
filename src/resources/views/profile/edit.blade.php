<x-base-layout title="用户编辑">
    <!-- 传递给sidebar的插槽，控制菜单选中状态 -->
    <x-slot:active>users</x-slot>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <div class="content-wrapper">
            <!-- 内容标题（页面标题） -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">用户编辑</h1>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 主体内容 -->
            <div class="content">
                <div class="container-fluid">

                    <div class="py-12">
                        <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</x-base-layout>