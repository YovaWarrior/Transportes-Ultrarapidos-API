<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    use HasFactory;

    protected $fillable = [
        'transportista_id',
        'nombre',
        'licencia',
        'telefono',
        'dpi',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
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