<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData ['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
 
 
        $carrito = new Carrito();
        $carrito->user_id = $user->id;
        $carrito->save();

        $user->carrito_id = $carrito->id;
$user->save();
        return response()->json([
            'message' => '****Usuario creado con éxito****',
            'access_token' => $token,
            'token_type' => 'Bearer'
            
        ]);

       
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
            
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }   

    public function infUser(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
{
    if ($request->user()) {
        $request->user()->tokens()->delete();
    }

    return response()->json([
        'message' => 'Successfully logged out'
    ]);
}

}
