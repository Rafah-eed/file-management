<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', [AuthController::class, '__invoke'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, '__invoke'])->name('dashboard');



use App\Http\Controllers\FileController;

Route::apiResource('files', FileController::class);

Route::patch('/files/{id}/set-active', [FileController::class, 'setActive']);
Route::patch('/files/{id}/set-reserved', [FileController::class, 'setReserved']);

Route::post('/uploadFile', [FileController::class, 'uploadFile'])->name('uploadFile');
Route::get('/downloadFile/{id}', [FileController::class, 'downloadFile'])->name('downloadFile');
