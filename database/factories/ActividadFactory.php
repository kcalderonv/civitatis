<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $inicio = $this->faker->dateTimeInInterval('-1 week', '+2 week');
        $fin = $this->faker->dateTimeInInterval('-1 week', '+10 week');
        do {
            $fin = $this->faker->dateTimeInInterval('-1 week', '+10 week');
        } while ($fin < $inicio);


        return [
            'titulo'=>$this->faker->text(60),
            'descripcion'=>$this->faker->text(200),
            'precio'=>$this->faker->numberBetween(50,200),
            'd_inicio'=>$inicio,
            'd_fin'=>$fin,
            'calificacion'=>$this->faker->numberBetween(1,5),

        ];
    }
}
