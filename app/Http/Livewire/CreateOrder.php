<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\Order;

use Gloudemans\Shoppingcart\Facades\Cart;



class CreateOrder extends Component
{
    public $address;
    public $reference;
    public $contact, $phone;

    public $envio_type = 1;

    public $departamentos;
    public $ciudades = [];
    public $distritos = [];

    public $departamento_id = "";
    public $ciudad_id = "";
    public $distrito_id = "";

    public $shipping_cost = 0;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];

    public function mount() {
        $this->departamentos = Departamento::all();
    }

    // cada vez q se modif el valor de $envio_type se llama a esta función
    public function updatedEnvioType($value) {
        if ($value == 1) { // recoger en tienda
            $this->resetValidation([
                'departamento_id',
                'ciudad_id',
                'distrito_id',
                'address',
                'reference'
            ]);
        }

    }

    public function create_order() {
        $rules = $this->rules;

        if ($this->envio_type == 2) { // si es Envio a domicilio hay q especificar rules adicionales
            $rules['departamento_id'] = 'required';
            $rules['ciudad_id'] = 'required';
            $rules['distrito_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);

        $order = new Order(); // creamos una instancia para meter los datos
        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = $this->shipping_cost;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::Content();
        $order->save();

        Cart::destroy();

        return redirect()->route('orders.payment', $order);

    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
