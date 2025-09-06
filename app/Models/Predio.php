<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais',
        'direccion',
        'telefono',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Relaciones
    public function bodegas()
    {
        return $this->hasMany(Bodega::class);
    }

    public function ordenesTrabajos()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}