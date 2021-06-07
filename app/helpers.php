<?php
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Gloudemans\Shoppingcart\Facades\Cart;

function getStock($product_id, $color_id = null, $size_id = null) {
    $product = Product::find($product_id);

    if ($size_id) {
        $size = Size::find($size_id);
        // si tiene size a la fuerza tiene tb color
        // como es una relacion muchos a muchos y tiene una tabla intermedia hay q acceder mediante pivot
        $cantidad = $size->colors->find($color_id)->pivot->quantity;
    }
    elseif ($color_id) {
        // solo tiene color (sin talla)
        // como es una relacion muchos a muchos y tiene una tabla intermedia hay q acceder mediante pivot
        $cantidad = $product->colors->find($color_id)->pivot->quantity;
    }else { // no hay ni color ni talla
        $cantidad = $product->quantity;
    }

    return $cantidad;
}

function cantidadesAddedCarrito($product_id, $color_id = null, $size_id = null) {
    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.color_id', $color_id)
                ->where('options.size_id', $size_id)
                ->first();

    // dd($item);

    if ($item) {
        return $item->qty;
    }
    else {
        return 0;
    }
}

function cantidadDisponible($product_id, $color_id = null, $size_id = null) {
     $cantTotal = getStock($product_id, $color_id, $size_id);
     $cantAdded = cantidadesAddedCarrito($product_id, $color_id, $size_id);
     return $cantTotal - $cantAdded;
}
