<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function contactEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'name' => 'required|string',
            'message' => 'required|string'
        ]);
        Mail::to('alex.joe.lytle@gmail.com')->send(new ContactEmail($request->name,$request->email,$request->message));

    }
}
