<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\UlanganController;
use App\Http\Controllers\SikapController;
use App\Http\Controllers\RapotController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\FgaleriController;
use App\Http\Controllers\FhomeController;
use App\Http\Controllers\FkontakController;
use App\Http\Controllers\FpengumumanController;
use App\Http\Controllers\FprofilController;
use App\Http\Middleware\Admin;

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

Route::get('/welcome', function () {
  return view('welcome');
});



Route::get('/clear-cache', function () {
  Artisan::call('config:clear');
  Artisan::call('cache:clear');
  Artisan::call('config:cache');
  return 'DONE';
});

Auth::routes();
Route::get('/login/cek_email/json', [UserController::class, 'cek_email']);
Route::get('/login/cek_password/json', [UserController::class, 'cek_password']);
Route::post('/cek-email', [UserController::class, 'email'])->name('cek-email')->middleware('guest');
Route::get('/reset/password/{id}', [UserController::class, 'password'])->name('reset.password')->middleware('guest');
Route::patch('/reset/password/update/{id}', [UserController::class, 'update_password'])->name('reset.password.update')->middleware('guest');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomeController::class, 'admin'])->name('admin.home');
  Route::get('/home', [HomeController::class, 'admin'])->name('admin.home');
  Route::get('/profile', [UserController::class, 'profile'])->name('profile');
  Route::get('/pengaturan/profile', [UserController::class, 'edit_profile'])->name('pengaturan.profile');
  Route::post('/pengaturan/ubah-profile', [UserController::class, 'ubah_profile'])->name('pengaturan.ubah-profile');
  Route::get('/pengaturan/edit-foto', [UserController::class, 'edit_foto'])->name('pengaturan.edit-foto');
  Route::post('/pengaturan/ubah-foto', [UserController::class, 'ubah_foto'])->name('pengaturan.ubah-foto');
  Route::get('/pengaturan/email', [UserController::class, 'edit_email'])->name('pengaturan.email');
  Route::post('/pengaturan/ubah-email', [UserController::class, 'ubah_email'])->name('pengaturan.ubah-email');
  Route::get('/pengaturan/password', [UserController::class, 'edit_password'])->name('pengaturan.password');
  Route::post('/pengaturan/ubah-password', [UserController::class, 'ubah_password'])->name('pengaturan.ubah-password');



  Route::middleware(['App\Http\Middleware\guru'])->group(function () {
    Route::resource('/nilai', 'App\Http\Controllers\NilaiController');
    Route::resource('/ulangan', 'App\Http\Controllers\UlanganController');
    Route::resource('/sikap', 'App\Http\Controllers\SikapController');
    Route::resource('/rapot', 'App\Http\Controllers\RapotController');
  });

  Route::middleware(['App\Http\Middleware\admin'])->group(function () {
    Route::middleware(['App\Http\Middleware\trash'])->group(function () {
      Route::get('/guru/restore/{id}', 'GuruController@restore')->name('guru.restore');
      Route::delete('/guru/kill/{id}', 'GuruController@kill')->name('guru.kill');
      Route::get('/kelas/restore/{id}', 'KelasController@restore')->name('kelas.restore');
      Route::delete('/kelas/kill/{id}', 'KelasController@kill')->name('kelas.kill');
      Route::get('/siswa/restore/{id}', 'SiswaController@restore')->name('siswa.restore');
      Route::delete('/siswa/kill/{id}', 'SiswaController@kill')->name('siswa.kill');
      Route::get('/mapel/trash', [MapelController::class, 'trash'])->name('mapel.trash');
      Route::get('/mapel/restore/{id}', 'MapelController@restore')->name('mapel.restore');
      Route::delete('/mapel/kill/{id}', 'MapelController@kill')->name('mapel.kill');
      Route::get('/user/trash', [UserController::class, 'trash'])->name('user.trash');
      Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore');
      Route::delete('/user/kill/{id}', 'UserController@kill')->name('user.kill');
    });
    Route::get('/home', [HomeController::class, 'admin'])->name('admin.home');
    Route::get('/absen/json', 'GuruController@json');
    Route::post('/guru/update-foto/{id}', 'GuruController@update_foto')->name('guru.update-foto');
    Route::post('/guru/upload', 'GuruController@upload')->name('guru.upload');
    Route::post('/guru/import_excel', 'GuruController@import_excel')->name('guru.import_excel');
    Route::delete('/guru/deleteAll', 'GuruController@deleteAll')->name('guru.deleteAll');
    Route::resource('/guru', 'App\Http\Controllers\GuruController');
    Route::get('/kelas/edit/json', 'KelasController@getEdit');
    Route::resource('/kelas', 'App\Http\Controllers\KelasController');
    Route::get('/siswa/view/json', 'SiswaController@view');
    Route::get('/listsiswapdf/{id}', 'SiswaController@cetak_pdf');
    Route::get('/siswa/ubah-foto/{id}', 'SiswaController@ubah_foto')->name('siswa.ubah-foto');
    Route::post('/siswa/update-foto/{id}', 'SiswaController@update_foto')->name('siswa.update-foto');
    Route::get('/siswa/export_excel', 'SiswaController@export_excel')->name('siswa.export_excel');
    Route::post('/siswa/import_excel', 'SiswaController@import_excel')->name('siswa.import_excel');
    Route::delete('/siswa/deleteAll', 'SiswaController@deleteAll')->name('siswa.deleteAll');
    Route::resource('/siswa', 'App\Http\Controllers\SiswaController');
    Route::get('/mapel/getMapelJson', 'MapelController@getMapelJson');
    Route::resource('/mapel', 'App\Http\Controllers\MapelController');
    Route::get('/jadwal/export_excel', 'JadwalController@export_excel')->name('jadwal.export_excel');
    Route::post('/jadwal/import_excel', 'JadwalController@import_excel')->name('jadwal.import_excel');
    Route::delete('/jadwal/deleteAll', 'JadwalController@deleteAll')->name('jadwal.deleteAll');
    Route::resource('/jadwal', 'App\Http\Controllers\JadwalController');
    Route::resource('/user', 'App\Http\Controllers\UserController');
  });
});
