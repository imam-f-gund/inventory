<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
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


Route::post('login', LoginController::class, '__invoke'); // Route login
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'store']); // Route register

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [App\Http\Controllers\Auth\MeController::class, 'index']);
    Route::post('logout', [App\Http\Controllers\Auth\LogoutController::class, 'index']);

    Route::resource('category', CategoryController::class)->except('show', 'edit');
    Route::resource('product', ProductController::class)->except('show', 'edit');
    Route::resource('stock', StokController::class)->only('show', 'index', 'store');
    
    Route::get('transaksi', [TransaksiController::class, 'index']);
   
    Route::middleware('cek:1')->group(function () {
        Route::resource('user', UserController::class);
    });
});
