<?php

use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SettingRolesController;
use App\Http\Controllers\Api\ProfilPerusahaanController;
use App\Http\Controllers\Api\AbsenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use App\Http\Controllers\API\AuthController;
//belum login
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


//sudah login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::middleware(['auth:sanctum', 'Admin'])->prefix('admin')->group(function () {
    Route::post('/search-user', [AuthController::class, 'search']);
    Route::resource('roles', RolesController::class);
    Route::resource('setting_roles', SettingRolesController::class);
    Route::resource('profil_perusahaan', ProfilPerusahaanController::class);
    Route::resource('absen', AbsenController::class);
});

Route::middleware(['auth:sanctum', 'Pegawai'])->prefix('pegawai')->group(function () {
    //
});
