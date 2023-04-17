<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfUserController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function update(Request $request)
{
    $user = $request->user();
    
    $validatedData = $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'string|min:8|confirmed'
    ]);

    if (isset($validatedData['name'])) {
        $user->name = $validatedData['name'];
    }

    if (isset($validatedData['email'])) {
        $user->email = $validatedData['email'];
    }

    if (isset($validatedData['password'])) {
        $user->password = Hash::make($validatedData['password']);
    }

    $user->save();

    return response()->json([
        'message' => 'User updated successfully'
    ]);
}

}
