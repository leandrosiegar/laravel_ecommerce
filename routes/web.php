<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PruebaController;

use App\Http\Controllers\SearchController;

use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;

Route::get('/', WelcomeController::class); // si no se especifica método se ejecuta por defecto el método __invoke

Route::get('search', SearchController::class)->name('search');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/prueba', [PruebaController::class, 'show']);

Route::get('/pruebaBorrarCarrito', function() {
    /* poniendo el \ delante de Cart no es necesario importarlo */
    \Cart::destroy();
});

// en este caso no asignamos una ruta a un controller sino directamente al
// componente livewire que hemos creado
Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

// en este caso no asignamos una ruta a un controller sino directamente al
// componente livewire que hemos creado
Route::get('orders/create', CreateOrder::class)->middleware('auth')->name('orders.create');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
