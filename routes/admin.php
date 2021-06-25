<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;

Route::get("/", ShowProducts::class)->name('admin.index');
Route::get("/products/{product}/edit", EditProduct::class)->name('admin.product.edit');


Route::get('product/create', CreateProduct::class)->name('admin.product.create');
