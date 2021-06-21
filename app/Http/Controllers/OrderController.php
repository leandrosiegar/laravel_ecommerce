<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment(Order $order) {
        $items = json_decode($order->content);
        // dd($items);
        return view('orders.payment', compact('order', 'items'));
    }

    public function show(Order $order) {
        return "estás en show de OrderController";
    }
}
