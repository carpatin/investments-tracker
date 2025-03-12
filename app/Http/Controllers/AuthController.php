<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            // Get the authenticated user
            $user = auth()->user();

            // Generate a token
            $token = $user->createToken('graphql-token')->plainTextToken;

            // Return the token
            return response()->json([
                'token' => $token,
                'user'  => $user,
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
