<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'actividades'=>$this->faker->text(50),
        ];
    }
}
