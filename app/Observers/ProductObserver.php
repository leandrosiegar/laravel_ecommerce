<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    public function updated(Product $product) {
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);
        if ($subcategory->size) { // tiene talla y color
            if ($product->colors->count()) {
                // borrar todos los reg de la tabla intermedia
                $product->colors()->detach();
            }
        }
        elseif ($subcategory->color) { // tiene solamente color
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }
        else { // no tiene ni talla ni color
            if ($product->colors->count()) {
                // borrar todos los reg de la tabla intermedia
                $product->colors()->detach();
            }
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }
    }
}
