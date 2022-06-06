<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Burger;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function logout(Request $request)
    {
        $burger = Burger::find($request->id);
        $burger->delete();
    }

    public function updateUser(Request $request)
    {

       $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $response = [
            'user' => $user,
        ];

        return response($response, 201);
    }
}
