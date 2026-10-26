<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Rutas de la web pública de DigiGrow
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nosotros', [PageController::class, 'about'])->name('about');
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
// Rutas del Día 8
Route::get('/catalogo', [PageController::class, 'catalogo'])->name('catalogo');
Route::get('/productos/{slug}', [PageController::class, 'productDetail'])->name('products.show');
//dia 9
Route::get('/servicios', [PageController::class, 'servicios'])->name('services');
Route::post('/contacto', [PageController::class, 'storeContact'])->name('contact.store');