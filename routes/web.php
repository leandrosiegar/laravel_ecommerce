<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PruebaController;

use App\Http\Controllers\SearchController;


Route::get('/', WelcomeController::class); // si no se especifica método se ejecuta por defecto el método __invoke

Route::get('search', SearchController::class)->name('search');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/prueba', [PruebaController::class, 'show']);

Route::get('/pruebaBorrarCarrito', function() {
    /* poniendo el \ delante de Cart no es necesario importarlo */
    \Cart::destroy();
});





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
