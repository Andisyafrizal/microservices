<?php

use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SettingRolesController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'change_password']);
    Route::post('/search-user', [AuthController::class, 'search']);

   Route::resource('roles', RolesController::Class);

   Route::resource('setting_roles',SettingRolesController::Class);
});
