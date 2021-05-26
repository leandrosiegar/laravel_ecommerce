<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at']; // guarded es lo contrario a fillable, es decir, metemos lo q no queremos por asign masiva

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
        return $this->hasMany(Color::class);
    }

    // relación uno a muchos polimórfica
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

}
