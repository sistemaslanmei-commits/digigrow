<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Rutas de la web pública de DigiGrow
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nosotros', [PageController::class, 'about'])->name('about');
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');