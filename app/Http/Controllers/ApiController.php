<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('userToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
