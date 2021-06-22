<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Order;


class WelcomeController extends Controller
{
    // la función de __invoke se usa cuando el controller va a tener un único método
    public function __invoke() {
        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        if ($pendiente) {
            $mensaje = "Tiene ".$pendiente." pedidos todavía pendientes <a class='font-bold' href='".route('orders.index')."?status=1'>Ir a pagar</a>";
            session()->flash('flash.banner', $mensaje);
        }

        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
}
