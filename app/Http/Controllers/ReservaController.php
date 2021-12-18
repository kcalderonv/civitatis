<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $reserva = Reserva::create($request->only('actividad_id','num_personas','precio','total','fecha_actividad')+[
            'user_id'=>Auth::user()->id,
            'fecha_reserva'=>date('y-m-d')
        ]);
        return Response($reserva, Response::HTTP_CREATED);
    }
}
