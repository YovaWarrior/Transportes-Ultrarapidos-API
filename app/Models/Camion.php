<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;

    protected $table = 'camiones';

    protected $fillable = [
        'transportista_id',
        'placa',
        'tipo',
        'capacidad',
        'estado',
        'año',
        'marca',
        'modelo'
    ];

    protected $casts = [
        'capacidad' => 'decimal:2',
        'año' => 'integer',
    ];

    // Relaciones
    public function transportista()
    {
        return $this->belongsTo(Transportista::class);
    }

    public function ordenesTrabajos()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}