<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user()
    {
        return auth()->user();
    }

    public function registro(UserRequest $request)
    {
        /*validar email */
        $validar = User::where('email',$request->input('email'))->first();
        if($validar){
            $message = array('message'=>'email ya resgistrado');
            return response($message, 422);
        }
        /* registrar */
        $user = User::create($request->only('name','email')+[
            'password'=> Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'error'=>'invalid credentials'
            ], Response:: HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();

        return response($user, Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response(null, Response::HTTP_CREATED);
    }
}
