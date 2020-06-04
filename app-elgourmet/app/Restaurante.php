<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property integer $id_userFK
 * @property User $user
 */
class Restaurante extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'direccion', 'id_userFK'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_userFK');
    }
}
