<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'ordenes_trabajo';

    protected $fillable = [
    'numero_orden',
    'camion_id',
    'piloto_id',
    'predio_id',
    'bodega_id',
    'estado'
];

    // Relaciones
    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function piloto()
    {
        return $this->belongsTo(Piloto::class);
    }

    public function predio()
    {
        return $this->belongsTo(Predio::class);
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class);
    }

    public function ingresoCamion()
    {
        return $this->hasOne(IngresoCamion::class);
    }

    public function egresoCamion()
    {
        return $this->hasOne(EgresoCamion::class);
    }

    public function valesCombustible()
    {
        return $this->hasMany(ValeCombustible::class);
    }
}
