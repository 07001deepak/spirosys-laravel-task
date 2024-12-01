<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\FilterController;
use Illuminate\Support\Facades\Route;
\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class;



Route::get('/', [DisplayController::class, 'table']);
Route::get('getrecords', [DisplayController::class, 'fetchRecords'])->name('getrecords');

Route::get('/task2',[FilterController::class,'index']);
Route::post('/fetch-data',[FilterController::class,'filterRecord'])->name('fetch_data');
