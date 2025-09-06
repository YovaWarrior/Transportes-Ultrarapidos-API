<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoCamion extends Model
{
    use HasFactory;

    protected $table = 'ingresos_camiones';

    protected $fillable = [
        'orden_trabajo_id',
        'origen',
        'tipo_carga',
        'fecha_ingreso',
        'user_id',
        'observaciones'
    ];

    protected $casts = [
        'fecha_ingreso' => 'datetime',
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
