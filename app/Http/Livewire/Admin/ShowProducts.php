<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;
    public $search;


    // uptatingXXX cada vez q se modifique la propiedad XXX se llama a este método
    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'LIKE', '%'.$this->search.'%')->paginate(10);

        // con ->layout especif q plantilla queremos q use (por defecto si no se pone se usa siempre layouts.app)
        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }
}
