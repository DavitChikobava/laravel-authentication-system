<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
            "password"=> [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            "password_confirmation" => "required"
        ],[
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.'
        ]
    );

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



    /**
     * Handle login attempt with email or phone
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password"=> "required"
        ]);

        $remember = $request->has('remember'); // Get remember me value
        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $credentials = [
            $loginField => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials, $remember)) // Pass remember value to attempt method
        {
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success", "User Logged in Successfully!");
        }

        $alternativeField = ($loginField === 'email') ? 'phone' : 'email';
        $alternativeCredentials = [
            $alternativeField => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($alternativeCredentials, $remember)) // Pass remember value here too
        {
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success", "User Logged in Successfully!");
        }

        return back()->with("error", "Invalid Email/Phone or Password");
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            $user->update([
                'remember_token' => null
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
