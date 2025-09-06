<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValeCombustible extends Model
{
    use HasFactory;

    protected $table = 'vales_combustible';

    protected $fillable = [
        'orden_trabajo_id',
        'cantidad_galones',
        'fecha_vale',
        'precio_galon',
        'total',
        'user_id',
        'observaciones'
    ];

    protected $casts = [
        'cantidad_galones' => 'decimal:2',
        'precio_galon' => 'decimal:2',
        'total' => 'decimal:2',
        'fecha_vale' => 'datetime',
    ];

    // Relaciones
    public function ordenTrabajo()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}