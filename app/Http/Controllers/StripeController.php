<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Charge;

use Illuminate\Support\Facades\DB;

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

        // dd($charge);exit;

        if ($charge->status == "succeeded") {

            DB::table('orders')
                ->where('id', $request->order_id)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update(['status' => 2]);


            return  redirect()->route('inicio')->with('mensaje', 'Tu compra se ha realizado correctamente');
        }
        else {
            return  redirect()->route('inicio')->with('mensaje', 'Se ha producido un error al realizar la compra');
        }




    }
}
