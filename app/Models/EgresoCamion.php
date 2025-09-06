<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgresoCamion extends Model
{
    use HasFactory;

    protected $table = 'egresos_camiones';

    protected $fillable = [
        'orden_trabajo_id',
        'destino',
        'tipo_carga',
        'fecha_egreso',
        'user_id',
        'kilometraje',
        'observaciones'
    ];

    protected $casts = [
        'fecha_egreso' => 'datetime',
        'kilometraje' => 'integer',
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