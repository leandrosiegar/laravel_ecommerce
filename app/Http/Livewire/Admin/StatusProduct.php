<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusProduct extends Component
{

    public $product;
    public $status;


    public function mount() {
        $this->status = $this->product->status;
    }

    public function save() {
        $this->product->status = $this->status;
        $this->product->save(); // guardarlo en la BD
        $this->emit("saved");
    }

    public function render()
    {
        return view('livewire.admin.status-product');
    }
}
