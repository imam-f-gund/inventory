<?php
use Illuminate\Support\Facades\Route;

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

 
Route::get('login', function () {
    return view('login');
});
Route::get('register', function () {
    return view('register');
});

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/stock', function () {
    return view('stock');
});
Route::get('/stock/{id}', function () {
    return view('detail-stok');
});
Route::get('/product', function () {
    return view('product');
});
Route::get('/transaksi-in', function () {
    return view('transaksi');
});
Route::get('/transaksi-out', function () {
    return view('transaksi');
});
Route::get('/monitoring-stok', function () {
    return view('monitoring-stok');
});
Route::get('/monitoring-kas', function () {
    return view('monitoring-kas');
});

