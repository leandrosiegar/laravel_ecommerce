<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;

    // guarded es lo contrario a fillable, decir q campos no queremos q se puedan meter masivamente
    // se usa guarded en vez de fillable cuando los campos a rellenar son muchísimos
    protected $guarded = ['id', 'status', 'created_at', 'updated_at'];

    // relacion uno a muchos (inversa)
    public function departamento() {
        return $this->belongsTo(Departamento::class);
    }

    public function ciudad() {
        return $this->belongsTo(Ciudad::class);
    }

    public function distrito() {
        return $this->belongsTo(Distrito::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
