<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActividadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => str_pad($this->id, 7, "0", STR_PAD_LEFT),
            'num_personas' => $this->num_personas,
            'precio' => $this->precio,
            'total' => $this->total,
            'fecha_actividad' => $this->fecha_actividad,
            'actividad' => $this->actividad->titulo,
        ];
    }
}
