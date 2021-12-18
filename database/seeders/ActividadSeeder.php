<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\ActividadSubActividad;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actividad::factory(50)->create()->each(function (Actividad $actividad){
            ActividadSubActividad::factory(random_int(1,10))->create([
                'actividad_id' => $actividad->id,
            ]);
        });
    }
}
