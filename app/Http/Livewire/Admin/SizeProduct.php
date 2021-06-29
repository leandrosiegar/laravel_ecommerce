<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Size;

class SizeProduct extends Component
{
    // se pasa el valor de product como parámetro desde resources\views\livewire\admin\edit-product.blade.php cuando se crea el componente
    public $product;

    protected $listeners = ['borrarTalla'];

    public $name;

    public $abrirModal = false;

    public $name_edit;
    public $size;

    protected $rules = [
        'name' => 'required'
    ];

    public function guardar() {
        $this->validate();

        $this->product->sizes()->create([
            'name' => $this->name
        ]);

        $this->product = $this->product->fresh();
        $this->reset(['name']);

    }

    public function edit(Size $size) {
        $this->abrirModal = true;
        $this->name_edit = $size->name;
        $this->size = $size;
    }

    public function actualizar() {
        $this->validate([
            'name_edit' => 'required'
        ]);
        $this->size->name = $this->name_edit;
        $this->size->save();
        $this->product = $this->product->fresh();
        $this->abrirModal = false;
    }

    public function borrarTalla(Size $size) {
        $size->delete();
        $this->product = $this->product->fresh();
    }


    public function render()
    {
        $sizes = $this->product->sizes;

        return view('livewire.admin.size-product', compact('sizes'));
    }
}
