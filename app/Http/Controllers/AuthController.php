<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }
    
    public function registerPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "surname" => "required",
            "phone" => "required",
            "email"=> "required|email|unique:users",
            "password"=> "required|confirmed|min:8",
            "password_confirmation" => "required"
        ]);

        $user = User::create([
            "name"=> $request->name,
            "surname" => $request->surname,
            "phone"=> $request->phone,
            "email"=> $request->email,
            "password"=> Hash::make($request->password)
        ]);

        dd($user);
    }
}
