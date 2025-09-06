<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $fillable = [
        'predio_id',
        'nombre',
        'descripcion',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Relaciones
    public function predio()
    {
        return $this->belongsTo(Predio::class);
    }

    public function ordenesTrabajos()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}