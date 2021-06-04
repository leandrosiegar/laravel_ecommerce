<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class AddCartItemSize extends Component
{
    // product se le pasa como parámetro cuando se crea el componente
    public $product;
    public $sizes;

    public $sizeSelected = "";
    public $colorSelected = "";

    public $colors = [];

    public $cantidad = 1;
    public $stock = 0;

    public function updatedSizeSelected($value) {

        $size = Size::find($value);
        $this->colors = $size->colors;

    }

    public function updatedColorSelected($value) {
        $size = Size::find($this->sizeSelected);
        $this->stock = $size->colors->find($value)->pivot->quantity;
    }

    public function mount() {
        $this->sizes = $this->product->sizes;
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }




}
