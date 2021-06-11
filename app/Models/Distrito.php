<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $fillable = ['name','ciudad_id'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
