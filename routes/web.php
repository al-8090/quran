<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

Route::view('/', 'home');
Route::get('/surat', [SuratController::class, 'index']);
Route::get('/surat/{nomor}', [SuratController::class, 'show'])->whereNumber('nomor');