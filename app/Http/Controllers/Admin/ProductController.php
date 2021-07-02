<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function files(Product $product, Request $request) {
        $request->validate([
            'fichero' => 'required|image|max:2048'
        ]);
        $url = Storage::put('products', $request->file('fichero'));

        $product->images()->create([
            'url' => $url
        ]);
    }
}
