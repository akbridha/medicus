<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\KeluargaController;
use App\Models\Keluarga;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Carbon\Carbon;
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
    $jumlahPasien = Pasien::count();
    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    $jumlahPasienBulanIni = Pasien::whereMonth('created_at', $bulanIni)
                        ->whereYear('created_at', $tahunIni)
                        ->count();

    // untuk menampilkan jumlah antrian
    $antrian = RekamMedis::where('pemeriksaan', 'belum diperiksa')->count();

// return $currentUser;
    return view('layouts.welcome', compact('currentUser','antrian','jumlahPasien', 'jumlahPasienBulanIni'));
})->name('home');



Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/sesi', [SessionController::class, 'index'])->name('session.index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('session.login');
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('session.logout');



// Route::get('/pasien', [PasienController::class, 'index']);



Route::group(
    ['middleware' =>['isAdmin']], function(){
        Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
        Route::get('pasien/create', [PasienController::class, 'create'])->name('pasien.create');
        Route::post('pasien/store', [PasienController::class, 'store'])->name('pasien.store');
        Route::post('pasien/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::get('/cari', [PasienController::class,'find' ])->name('cari');
        Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
        Route::get('/hapus', [PasienController::class, 'destroy'])->name('pasien.hapus');
    }
);



// ######### Keluarga
Route::get('/form_keluarga', [KeluargaController::class, 'index'])->name('keluarga.index');
Route::get('/create_keluarga', [KeluargaController::class, 'create'])->name('keluarga.create');
Route::get('/tambah_cari_keluarga', [KeluargaController::class, 'findPasien'])->name('keluarga.pasien.find');
Route::get('/cari_keluarga_pasien', [KeluargaController::class, 'find'])->name('keluarga.find');
Route::post('/pilih_pasien_keluarga', [KeluargaController::class, 'pilihPasienKeluarga'])->name('keluarga.pasien.pilih');
Route::post('/keluarga/store', [KeluargaController::class, 'store'])->name('keluarga.store');
Route::delete('/keluarga/{keluarga}', [KeluargaController::class, 'destroy'])->name('keluarga.pasien.destroy');
Route::post('/keluarga/clear-session', [KeluargaController::class, 'clearSession'])->name('keluarga.clear-session');


Route::group(
    ['middleware' =>['isDocter']], function(){
        Route::get('/rm', [RekamMedisController::class, 'index'])->name('rm.index');
        Route::get('/rm/show/{id}', [RekamMedisController::class, 'show'])->name('rm.show');
        // Route::get('/rm/edit/{id}', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::get('/rm/antrian', [RekamMedisController::class, 'antrian'])->name('rm.antrian');
        Route::post('/rm/store', [RekamMedisController::class, 'store'])->name('rm.store');
        Route::put('/rm/{rekamMedis}', [RekamMedisController::class, 'update'])->name('rm.update');

        // Route::get('/rm/{rekamMedis}/{pasien}/edit', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::get('/rm/{rekamMedis}/periksa', [RekamMedisController::class, 'periksa'])->name('rm.periksa');
        Route::get('/rm/{rekamMedis}/edit', [RekamMedisController::class, 'edit'])->name('rm.edit');
        Route::post('/rm/create', [RekamMedisController::class, 'create'])->name('rm.create');
    }
);

Route::post('/rm/regis', [RekamMedisController::class, 'regis'])->name('rm.regis');
Route::post('/rm/daftar', [RekamMedisController::class, 'daftar'])->name('rm.daftar');

Route::get('/logistik', [LogistikController::class,'index'])->name('logistik.index');

Route::get('/export_db', [DatabaseController::class,'eksport']);
Route::get('/cek_path', function(){echo getenv('PATH');});
// Route::get('/add_sql_to_path', function(){echo getenv('PATH');});
