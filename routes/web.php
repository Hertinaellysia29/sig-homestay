<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardWisataController;
use App\Http\Controllers\AdminDesaController;
use App\Http\Controllers\DashboardHomestayController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\Wisata as ControllersWisata;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('beranda', [
        'title' => 'Beranda',
        'active' => 'beranda'
    ]);
});

Route::get('/tentang', function () {
    return view('tentang', [
        'title' => 'Tentang',
        'active' => 'tentang'
    ]);
});

Route::get('/peta', function () {
    return view('peta', [
        'title' => 'Peta',
        'active' => 'peta'
    ]);
});

// Route::get('/homestay', function () {
//     return view('homestay', [
//         'title' => 'Homestay',
//         'active' => 'homestay'
//     ]);
// });
Route::get('/homestay', [HalamanUtamaController::class, 'homestay']);
Route::get('/homestay/{id}', [HalamanUtamaController::class, 'homestayDetail']);

Route::get('/wisata', [ControllersWisata::class, 'index']);
Route::get('/wisata/{id}', [ControllersWisata::class, 'detailWisata']);

Route::get('/hubungi-kami', function () {
    return view('hubungi-kami', [
        'title' => 'Hubungi Kami',
        'active' => 'hubungi-kami'
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::resource('/dashboard/wisata', DashboardWisataController::class)->middleware('auth');

Route::resource('/dashboard/desa', AdminDesaController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/homestay', DashboardHomestayController::class)->middleware('auth');
