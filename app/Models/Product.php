<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ColorSize;
use App\Models\ColorProduct;

class Product extends Model
{
    use HasFactory;


    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id', 'created_at', 'update_at']; // guarded es lo contrario a fillable, es decir, metemos lo q no queremos por asign masiva

    // Accesores
    // los accesores deben llamarse getXXXAttribute
    // Y para llamarlo desde la view solo poner {{ $product->stock }}
    public function getStockAttribute() {

    }

    // Relación uno a muchos
    public function sizes() {
        return $this->hasMany(Size::class);
    }

    // Relación uno a muchos (inversa)
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // Relación uno a muchos (inversa)
    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    // relación muchos a muchos
    public function colors() {
        // return $this->belongsToMany(Color::class);
        // con withPivot conseguimos q podamos acceder a ese campo quantity cuando lo llamemos desde product->colors
        // ya q por defecto no devuelve ningún valor (solo establece la relación)
        return $this->belongsToMany(Color::class)->withPivot('quantity','id');
    }

    // relación uno a muchos polimórfica
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    // Url amigable
    public function getRouteKeyName() {
        return 'slug';
    }

}
