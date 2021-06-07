<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

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

    public $options = [];

    public function mount() {
        $this->sizes = $this->product->sizes;
        $this->options['rutaImagen'] = Storage::url($this->product->images->first()->url);
    }

    public function incrementar() {
        $this->cantidad++;
    }

    public function decrementar() {
        $this->cantidad--;
    }

    public function addItem() {
        Cart::add(
            [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->cantidad,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);

        // emitTo hace que se ejecute solo el componente dropdown-carrito, si se pusiera solo emit lo escucharía todos
        $this->emitTo('dropdown-carrito', 'render');
    }

    public function updatedSizeSelected($value) {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
    }

    public function updatedColorSelected($value) {
        $size = Size::find($this->sizeSelected);
        $color = $size->colors->find($value);

        $this->stock = $color->pivot->quantity;
        $this->options['color'] = $color->name;
    }



    public function render()
    {
        return view('livewire.add-cart-item-size');
    }




}
