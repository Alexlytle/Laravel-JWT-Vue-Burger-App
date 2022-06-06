<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
   }

   public function login(Request $request) {
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            // Check email
            $user = User::where('email', $fields['email'])->first();

            // Check password
            if(!$user || !Hash::check($fields['password'], $user->password)) {
                return response([
                    'message' => 'Bad creds'
                ], 401);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
    }
    public function loginUser()
    {
        return 'not auth';
    }
    
    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
    public function whosLoggedIn()
    {
        return auth('sanctum')->user();
    }

    public function user()
    {
        return auth()->user()->burger;
    }

 
}