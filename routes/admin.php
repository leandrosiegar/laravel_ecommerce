<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;

Route::get("/", ShowProducts::class)->name('admin.index');
Route::get("/products/{product}/edit", function() {

})->name('admin.product.edit');


Route::get('product/create', CreateProduct::class)->name('admin.product.create');
