<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Order;


class WelcomeController extends Controller
{
    // la función de __invoke se usa cuando el controller va a tener un único método
    public function __invoke() {
        $pendiente = null;
        if (auth()->user()) {
            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
            if ($pendiente) {
                // session()->flash('flash.banner', $mensaje);
                session()->flash('pendiente', $pendiente);
            }
        }
        $categories = Category::all();
        return view('welcome', compact('categories', 'pendiente'));
    }
}
