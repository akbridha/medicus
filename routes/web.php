<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\SessionController;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    $currentUser  = Auth::user();
    return view('layouts.welcome', compact('currentUser'));
})->name('home');



Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/sesi', [SessionController::class, 'index'])->name('session.index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('session.login');
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('session.logout');



// Route::get('/pasien', [PasienController::class, 'index']);


Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::get('pasien/create', [PasienController::class, 'create'])->name('pasien.create');
Route::post('pasien/store', [PasienController::class, 'store'])->name('pasien.store');
Route::post('pasien/edit', [PasienController::class, 'edit'])->name('pasien.edit');
Route::get('/cari', [PasienController::class,'find' ])->name('cari');
Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');

Route::group(
    ['middleware' =>['isDocter']], function(){
        Route::get('/rm', [RekamMedisController::class, 'index'])->name('rm.index');
        Route::get('/rm/show/{id}', [RekamMedisController::class, 'show'])->name('rm.show');
        // Route::get('/rm/edit/{id}', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::get('/rm/antrian', [RekamMedisController::class, 'antrian'])->name('rm.antrian');
        Route::post('/rm/store', [RekamMedisController::class, 'store'])->name('rm.store');
        Route::put('/rm/{rekamMedis}', [RekamMedisController::class, 'update'])->name('rm.update');

        // Route::get('/rm/{rekamMedis}/{pasien}/edit', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::get('/rm/{rekamMedis}/edit', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::post('/rm/create', [RekamMedisController::class, 'create'])->name('rm.create');
    }
);

Route::post('/rm/regis', [RekamMedisController::class, 'regis'])->name('rm.regis');
Route::post('/rm/daftar', [RekamMedisController::class, 'daftar'])->name('rm.daftar');

Route::get('/logistik', [LogistikController::class,'index'])->name('logistik.index');
