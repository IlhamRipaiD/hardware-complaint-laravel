<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PengaduanController;

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
//LOGIN
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('box-login', [LoginController::class, 'login'])->name('box-login');
Route::get('tanggapan', [LoginController::class, 'tanggapan'])->name('tanggapan');
Route::get('user', [LoginController::class, 'user'])->name('user');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

//RUTE ADMIN
Route::get('admin', [HomeController::class, 'admin'])->name('admin')->middleware('auth');
Route::get('visualisasidata', [HomeController::class, 'visualisasiPengaduan'])->name('visualisasidata');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

//LOGOUT
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

// Route untuk mengirim notifikasi ke Telegram
Route::post('/send-test-message', [HomeController::class, 'testSendMessage']);

//RUTE KABID
Route::get('riwayattanggapan', [HomeController::class, 'riwayattanggapan'])->name('riwayattanggapan')->middleware('auth');
Route::delete('/delete_tanggapan/{id}',  [HomeController::class, 'delete_tanggapan'])->name('delete_tanggapan');
Route::get('/halExportPDF', [HomeController::class, 'halExportPDF'])->name('halExportPDF');
Route::get('export-pdf', [HomeController::class, 'exportPDF'])->name('exportPDF');

//RUTE KABAG
// Route::get('tanggapan', [HomeController::class, 'tanggapan'])->name('tanggapan')->middleware('auth');
Route::get('/exporttoexcel', [PengaduanController::class, 'exporttoexcel'])->name('exporttoexcel');
Route::get('kabag', [HomeController::class, 'kabag'])->name('kabag');
Route::get('/rekap', [HomeController::class, 'rekap'])->name('rekap');

//RUTE TEKNISI
Route::get('teknisi', [HomeController::class, 'teknisi'])->name('teknisi');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [HomeController::class, 'update'])->name('update');
Route::delete('/delete/{id}',  [HomeController::class, 'delete'])->name('delete');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::delete('/delete-foto/{id}', [HomeController::class, 'deleteFoto'])->name('deleteFoto');

//RUTE USER
Route::get('riwayatpengaduan', [HomeController::class, 'riwayatpengaduan'])->name('riwayatpengaduan');
Route::post('actioninsert', [HomeController::class, 'actioninsert'])->name('actioninsert');
Route::post('actiontanggapan', [HomeController::class, 'actiontanggapan'])->name('actiontanggapan');
Route::get('/searchuser', [HomeController::class, 'searchuser'])->name('searchuser');

