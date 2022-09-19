<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/homestay', function () {
    return view('homestay', [
        'title' => 'Homestay',
        'active' => 'homestay'
    ]);
});

Route::get('/wisata', [ControllersWisata::class, 'index']);
Route::get('/wisata/{id}', [ControllersWisata::class, 'detailWisata']);

Route::get('/hubungi-kami', function () {
    return view('hubungi-kami', [
        'title' => 'Hubungi Kami',
        'active' => 'hubungi-kami'
    ]);
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);
