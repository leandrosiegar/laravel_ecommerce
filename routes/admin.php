<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get("/", ShowProducts::class)->name('admin.index');
Route::get("/products/{product}/edit", EditProduct::class)->name('admin.product.edit');


Route::get('product/create', CreateProduct::class)->name('admin.product.create');

Route::post('/products/{product}/files', [ProductController::class, 'files'])->name('admin.product.files');

Route::get("categories", [CategoryController::class, 'index'])->name('admin.categories.index');
