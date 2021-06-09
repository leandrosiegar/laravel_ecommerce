<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class SearchController extends Controller
{
    // __invoke es como el constructor, si no especificas ningún método se llama a este
    public function __invoke(Request $request) {
        $products = Product::where('name', "LIKE", "%".$request->nomProductoSearch."%")
                        ->where('status', 2)
                        ->paginate(8);

        return view('search', compact('products'));
    }
}
