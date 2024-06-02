<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginrequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login( AuthLoginrequest $request )
    {
        $creadentials = $request->validated();

        if ( !Auth::attempt($creadentials) )
        {
            return response()->json([
                "message" => "Credenciales incorrectas"
            ], 401);
        }

        $user = User::find( Auth::user()['id'] );
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            "token" => $token
        ]);
    }

    public function logout( Request $request )
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            "message" => "La sesion de cerror correctamente"
        ]);

    }

    public function register( AuthRegisterRequest $request )
    {
        $credentials = $request->validated();
        $user = User::create($credentials);

        return response()->json([
            "message" => "Se registro el usuario con exito",
            'user' => new UserResource($user),
        ]);


    }

    public function checkToken( Request $request )
    {
        $user = $request->user();

        return response()->json([
            'user' => new UserResource($user),
        ]);

    }

}
