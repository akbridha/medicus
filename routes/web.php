<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Models\RekamMedis;
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
    return view('layouts.welcome');
});
// Route::get('/pasien', [PasienController::class, 'index']);


Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::get('/rm', [RekamMedisController::class, 'index'])->name('rm.index');
Route::get('/rm/show/{id}', [RekamMedisController::class, 'show'])->name('rm.show');
