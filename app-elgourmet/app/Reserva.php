<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $telefono
 * @property int $cantidad
 * @property string $fecha
 * @property string $codigo
 * @property int $estado
 * @property int $id_mesaFK
 * @property Mesa $mesa
 */
class Reserva extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['telefono', 'cantidad', 'fecha', 'codigo', 'estado', 'id_mesaFK'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mesa()
    {
        return $this->belongsTo('App\Mesa', 'id_mesaFK');
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'datetime',
    ];
}
