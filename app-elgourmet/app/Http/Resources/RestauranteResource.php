<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //el texto keyMostrada se pone únicamente para observar que
        //lo que pongamos ahí lo devolverá en el json.
        //En un resource la palabra: $this hace referencia a la clase del modelo
        //así nosotros debemos poner los nombres de las propiedades del modelo:
        //$this->idproducto significa que queremos la propiedad: idproducto del modelo: Producto
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
        ];
    }

}
