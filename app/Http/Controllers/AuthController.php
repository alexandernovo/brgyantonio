<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'type' => 'required',
        ]);

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {

            $request->session()->regenerate();

            // Get logged in user
            $user = Auth::user();

            // Check portal type
            if ($user->type != $credentials['type']) {

                Auth::logout();

                return response()->json([
                    'status' => 'error',
                    'message' => 'This account is not allowed for this login portal.',
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid username or password.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
