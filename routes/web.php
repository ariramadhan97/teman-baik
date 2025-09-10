<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengaduanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

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

Route::get('/lp', function () {
    return view('landing');
});

Route::get('/download', [DashboardController::class, 'exportData'])->middleware('auth');

Route::get('/', function () {
    return view('/landing');
});
// Route::get('/well', function () {
//     return view('/welcome');
// });
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/form', [DashboardController::class, 'pengaduan']);

Route::get('/getDataAduan/{id}', [DashboardController::class, 'getDataAduan'])->middleware('auth');

Route::post('/teruskan-aduan', [DashboardController::class, 'teruskanAduan'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/pengaduan', PengaduanController::class);

Route::resource('/pengaduan', PengaduanController::class);

Route::resource('/manajemen-instansi', InstansiController::class)->middleware('auth');
