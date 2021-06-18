<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Charge;

class StripeController extends Controller
{
    public function pagar(Request $request) {
        // dd($request);
        Stripe::setApiKey(config('services.stripe.secret'));
        $token = $request->stripeToken;
        // dd($token);
        // dd($request->cantidadPagar);
        $charge = Charge::create([
            'amount' => $request->cantidadPagar, // 15.99 €
            'currency' => 'eur',
            'description' => $request->descPago,
            'source' => $token,
        ]);

        // dd($charge);

        return  redirect()->route('inicio')->with('mensaje', 'Tu compra se ha realizado correctamente');


    }
}
