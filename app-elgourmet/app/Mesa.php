<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property int $capacidad
 * @property int $id_restauranteFK
 * @property Restaurante $restaurante
 */
class Mesa extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'capacidad', 'id_restauranteFK'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurante()
    {
        return $this->belongsTo('App\Restaurante', 'id_restauranteFK');
    }
}
