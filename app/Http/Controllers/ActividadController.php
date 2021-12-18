<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        return Actividad::where('d_fin','>',Carbon::now())->orderBy('calificacion','desc')->orderBy('d_inicio','asc')->get();
    }

    public function show(Actividad $actividad)
    {
        return $actividad;
    }
}
