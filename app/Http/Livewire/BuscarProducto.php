<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class BuscarProducto extends Component
{
    public $search;
    public $abrir = false;

    // se llama automáticamente cada vez q cambie el valor de $search
    public function updatedSearch($value) {
        if ($value) { // si hay algo escrito
            $this->abrir = true;
        }
        else { // si no hay nada escrito
            $this->abrir = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            // take es lo mismo que limit 0,8
            $products = Product::where('name', "LIKE", "%".$this->search."%")
                        ->where('status', 2)
                        ->take(8)
                        ->get();
        }
        else {
            $products = [];
        }

        return view('livewire.buscar-producto', compact("products"));
    }
}
