<?php

namespace Database\Factories;

use App\Models\SubActividad;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActividadSubActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_actividad_id' => SubActividad::inRandomOrder()->first()->id
        ];
    }
}
