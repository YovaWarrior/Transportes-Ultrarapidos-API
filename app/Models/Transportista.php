<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'nit',
        'telefono',
        'direccion',
        'email',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Relaciones
    public function camiones()
    {
        return $this->hasMany(Camion::class);
    }

    public function pilotos()
    {
        return $this->hasMany(Piloto::class);
    }
}