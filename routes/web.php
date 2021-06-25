<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrondendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KabkotaController;
use App\Http\Controllers\KategoriwisataController;
use App\Http\Controllers\WisataController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index']);

//Kabupaten Kota
Route::get('/kabkota', [KabkotaController::class, 'index']);
Route::get('/kabkota/add', [KabkotaController::class, 'store']);
Route::post('/kabkota/create', [KabkotaController::class, 'create']);
Route::get('/kabkota/edit/{id}', [KabkotaController::class, 'edit']);
Route::post('/kabkota/update/{id}', [KabkotaController::class, 'update']);
Route::get('/kabkota/delete/{id}', [KabkotaController::class, 'destroy']);

//Kategoori
Route::get('/kategori', [KategoriwisataController::class, 'index']);
Route::get('/kategori/add', [KategoriwisataController::class, 'store']);
Route::post('/kategori/create', [KategoriwisataController::class, 'create']);
Route::get('/kategori/edit/{id}', [KategoriwisataController::class, 'edit']);
Route::post('/kategori/update/{id}', [KategoriwisataController::class, 'update']);
Route::get('/kategori/delete/{id}', [KategoriwisataController::class, 'destroy']);

//Wisata
Route::get('/wisata', [WisataController::class, 'index']);
Route::get('/wisata/add', [WisataController::class, 'store']);
Route::post('/wisata/create', [WisataController::class, 'create']);
Route::get('/wisata/edit/{id}', [WisataController::class, 'edit']);
Route::post('/wisata/update/{id}', [WisataController::class, 'update']);
Route::get('/wisata/delete/{id}', [WisataController::class, 'destroy']);

//Front End
Route::get('/', [FrondendController::class, 'index'])->name('frondend.index');
Route::get('/maps', [FrondendController::class, 'maps']);
Route::get('/kabkota/{id}', [FrondendController::class, 'kabkota']);
Route::get('/kategori/{id}', [FrondendController::class, 'kategori']);
Route::get('/detailwisata/{id}', [FrondendController::class, 'show']);
