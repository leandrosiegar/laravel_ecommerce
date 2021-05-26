<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','image','icon'];

    // relación uno a muchos
    public function subcategories() {
        return $this->hasMany(Subcategory::class);
    }

    // relación muchos a muchos
    public function brands() {
        return $this->belongsToMany(Brand::class);
    }

    public function products() {
        // se relacionan "a través" de la tabla subcategory (no hay una relación directa entre las tablas)
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }
}
