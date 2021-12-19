<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActividadResource;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReservaController extends Controller
{
    public function index()
    {
        $reserva = Reserva::with('actividad')
        ->where('user_id',auth()->user()->id)
        ->orderBy('fecha_actividad','desc')
        ->get();

        return ActividadResource::collection($reserva);
    }

    public function store(Request $request)
    {
        $reserva = Reserva::create($request->only('actividad_id','num_personas','precio','total','fecha_actividad')+[
            'user_id'=>Auth::user()->id,
            'fecha_reserva'=>date('y-m-d')
        ]);

        $reserva = new ActividadResource($reserva);

        return Response($reserva, Response::HTTP_CREATED);
    }
}
