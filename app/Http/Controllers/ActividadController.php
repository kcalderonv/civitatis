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

    public function show($id)
    {
        return Actividad::with('subactividad')->where('id',$id)->first();
    }

    public function search(Request $request)
    {
        $actividades = Actividad::where('d_inicio','<=',$request->fecha_actividad)
        ->where('d_fin','>=',$request->fecha_actividad)
        ->orderBy('calificacion','desc')
        ->get();
        return $actividades;
    }
}
