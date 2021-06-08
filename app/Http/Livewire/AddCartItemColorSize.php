<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColorSize extends Component
{
    public $product;
    public $sizes;

    public $sizeSelected = "";
    public $colorSelected = "";

    public $colors = [];

    public $cantidad = 1;
    public $stock = 0;

    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

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

        // actualizar el stock
        $this->stock = cantidadDisponible($this->product->id, $this->options['color_id'], $this->options['size_id']);
        $this->reset('cantidad');
        $this->reset('colorSelected');
        $this->reset('sizeSelected');

        // emitTo hace que se ejecute solo el componente dropdown-carrito, si se pusiera solo emit lo escucharía todos
        $this->emitTo('dropdown-carrito', 'render');
    }

    public function updatedSizeSelected($value) {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size_id'] = $size->id;
        $this->options['size_name'] = $size->name;
    }

    public function updatedColorSelected($value) {
        $size = Size::find($this->sizeSelected);
        $color = $size->colors->find($value);

        $this->options['color_id'] = $color->id;
        $this->options['color_name'] = $color->name;

        $this->stock = cantidadDisponible($this->product->id, $this->options['color_id'], $this->options['size_id']);
    }

    public function render()
    {
        return view('livewire.add-cart-item-color-size');
    }
}
