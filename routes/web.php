<?php

use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CvController::class, 'index'])->name('cv');

Route::post('/contact', [CvController::class, 'contact'])
    ->middleware('throttle:5,1')
    ->name('cv.contact');
