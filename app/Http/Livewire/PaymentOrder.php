<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{

    use AuthorizesRequests;

    public $order;
    protected $listeners = ['payOrder'];

    public function mount(Order $order) {
        $this->order = $order;
    }

    public function payOrder() {
        $this->order->status = 2; // RECIBIDO (PAGADO)
        $this->order->save();
        return redirect()->route('orders.show', $this->order);
    }

    public function render()
    {
        $this->authorize('esSuyo', $this->order);
        $this->authorize('yaPagado', $this->order); // pq es absurdo permitir q acceda a la view de pagar si ya lo ha pagado antes

        $items = json_decode($this->order->content);
        return view('livewire.payment-order', compact('items'));
    }
}
