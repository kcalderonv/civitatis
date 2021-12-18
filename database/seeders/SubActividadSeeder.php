<?php

namespace Database\Seeders;

use App\Models\SubActividad;
use Illuminate\Database\Seeder;

class SubActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubActividad::factory(30)->create();
    }
}
