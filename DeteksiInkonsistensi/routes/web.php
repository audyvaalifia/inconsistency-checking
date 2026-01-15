<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControl;

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

Route::post('/save-csv', [HomeControl::class, 'simpanKeCSV'])->name('save.csv');
//DI ATAS CUMA BUAT DEBUG
Route::post('/normalisasi-nlp', [HomeControl::class, 'normalizeSentence'])->name('normalisasi.nlp');
Route::post('/process-nlp', [HomeControl::class, 'buildRDF'])->name('process.nlp');
Route::get('/', [HomeControl::class, 'index']);