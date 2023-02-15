<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BeritaController,MasyarakatController,KontakController,PeopleController};
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [BeritaController::class,'index']);
Route::post('/barang/create', [BeritaController::class,'create'])->name('barang.create');
Route::post('/barang/update/{id}', [BeritaController::class,'update'])->name('barang.update');
Route::delete('/barang/delete/{id}', [BeritaController::class,'delete'])->name('barang.delete');

Route::get('/masyarakat', [MasyarakatController::class,'index']);
Route::post('/masyarakat/create', [MasyarakatController::class,'create'])->name('masyarakat.create');
Route::post('/masyarakat/update/{id}', [MasyarakatController::class,'update'])->name('masyarakat.update');
Route::delete('/masyarakat/delete/{id}', [MasyarakatController::class,'delete'])->name('masyarakat.delete');

Route::get('/history', [PeopleController::class,'index']);
Route::post('/history/create', [PeopleController::class,'create'])->name('history.create');
Route::post('/history/update/{id}', [PeopleController::class,'update'])->name('history.update');
Route::delete('/history/delete/{id}', [PeopleController::class,'delete'])->name('history.delete');

Route::get('/lelang', [KontakController::class,'index']);
Route::post('/lelang/create', [KontakController::class,'create'])->name('lelang.create');
Route::post('/lelang/update/{id}', [KontakController::class,'update'])->name('lelang.update');
Route::delete('/lelang/delete/{id}', [KontakController::class,'delete'])->name('lelang.delete');

