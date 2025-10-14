<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        auth()->login($user);

        return redirect()->route("dashboard")->with("success", "User Registered Sucessfully!");
    }

    public function dashboard(Request $request)
    {
        return view("dashboard");
    }

    public function login(Request $request)
    {
        return view("auth.login");
    }

    // public function loginPost(Request $request)
    // {
    //     $request->validate([
    //         "email" => "required",
    //         "password"=> "required"
    //     ]);

    //     if(auth()->attempt(["email" => $request->email,"password"=> $request->password]))
    //     {
    //         return redirect()->route("dashboard")->with("success", "User Logged in Sucessfully!");
    //     }

    //     return back()->with("error", "Ivalid Email or Password");
    // }

    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password"=> "required"
        ]);

        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $credentials = [
            $loginField => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success", "User Logged in Successfully!");
        }

        $alternativeField = ($loginField === 'email') ? 'phone' : 'email';
        $alternativeCredentials = [
            $alternativeField => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($alternativeCredentials))
        {
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success", "User Logged in Successfully!");
        }

        return back()->with("error", "Invalid Email/Phone or Password");
    }
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route("login");
    }
}
