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

// ********************************
function descontarDelStock($item) {
    $product = Product::find($item->id);
    $cant = cantidadDisponible($item->id, $item->options->color_id, $item->options->size_id);
    if ($item->options->size_id) { // tiene color y talla
        $size = Size::find($item->options->size_id);
        $size->colors()->detach($item->options->color_id); // detach elimina el registro de la tabla intermed entre color y size
        $size->colors()->attach([ // add el nuevo reg en la tabla intermedia pero con la nueva cantidad
            $item->options->color_id => ['quantity' => $cant]
        ]);
    }
    elseif($item->options->color_id) { // tiene solo color
        $product->colors()->detach($item->options->color_id); // detach elimina el registro de la tabla intermed
        $product->colors()->attach([ // add el nuevo reg en la tabla intermedia pero con la nueva cantidad
            $item->options->color_id => ['quantity' => $cant]
        ]);

    }
    else { // no tiene ni color ni talla
        $product->quantity = $cant;
        $product->save();
    }
}

// ********************************
function incrementarStock($item) {
    $product = Product::find($item->id);
    $cant = getStock($item->id, $item->options->color_id, $item->options->size_id) + $item->qty;
    if ($item->options->size_id) { // tiene color y talla
        $size = Size::find($item->options->size_id);
        $size->colors()->detach($item->options->color_id); // detach elimina el registro de la tabla intermed entre color y size
        $size->colors()->attach([ // add el nuevo reg en la tabla intermedia pero con la nueva cantidad
            $item->options->color_id => ['quantity' => $cant]
        ]);
    }
    elseif($item->options->color_id) { // tiene solo color
        $product->colors()->detach($item->options->color_id); // detach elimina el registro de la tabla intermed
        $product->colors()->attach([ // add el nuevo reg en la tabla intermedia pero con la nueva cantidad
            $item->options->color_id => ['quantity' => $cant]
        ]);

    }
    else { // no tiene ni color ni talla
        $product->quantity = $cant;
        $product->save();
    }
}
