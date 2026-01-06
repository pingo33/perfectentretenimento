<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::match(['get', 'post'], '/', [HomeController::class, 'index'])->name('home');

// rota SEM conflito com pasta física
Route::get('/videos-list', [HomeController::class, 'listVideos'])
     ->name('videos.list');
