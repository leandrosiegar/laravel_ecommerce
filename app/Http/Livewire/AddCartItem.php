<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $product;
    public $cantidad = 1;
    public $stock;

    public $options = [];

    public function mount() {
        $this->stock = $this->product->quantity;


        $this->options['rutaImagen'] = Storage::url($this->product->images->first()->url);

    }

    public function incrementar() {
        $this->cantidad++;
    }

    public function decrementar() {
        $this->cantidad--;
    }

    public function addItem() {
        // id, name, qty, price y weight son campos obligatorios del paquete de shoppingcart
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


    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
