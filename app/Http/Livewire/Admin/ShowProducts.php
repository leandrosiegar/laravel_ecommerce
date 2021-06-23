<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ShowProducts extends Component
{
    public $search;

    public function render()
    {
        $products = Product::paginate(10);

        // con ->layout especif q plantilla queremos q use (por defecto si no se pone se usa siempre layouts.app)
        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }
}
