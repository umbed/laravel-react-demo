<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// 主页
Route::get('/', [HomeController::class, 'show']);
Route::get('dashboard', [HomeController::class, 'show'])->name('dashboard');
Route::get('home', [HomeController::class, 'show']);

// 用户管理
Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'show');
    Route::get('/list', 'store');
    Route::post('/delete', 'delete');
});

// 设备管理
Route::prefix('devices')->controller(DeviceController::class)->group(function () {
    Route::get('/', 'show');
    Route::get('/list', 'store');
    Route::get('/more', 'more');
});

// 作业信息
Route::prefix('work')->controller(WorkController::class)->group(function () {
    Route::get('/', 'show');
    Route::get('/list', 'list');
});


Route::prefix('test')->controller(TestController::class)->group(function () {
    Route::get('/token/create', 'tokenCreate');
    Route::get('/auth', 'testAuth');
});
