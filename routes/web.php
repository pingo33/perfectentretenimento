<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::match(['get','post'], '/', [HomeController::class, 'index'])->name('home');
Route::get('/videos', [HomeController::class, 'listVideos']);
