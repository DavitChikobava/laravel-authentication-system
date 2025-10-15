<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

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
            "phone" => [
                'required',
                'unique:users,phone',
                'regex:/^\+995[5-9][0-9]{8}$/'
            ],
            "email"=> "required|email|unique:users",
            "password"=> [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            "password_confirmation" => "required"
        ],[
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'phone.regex' => 'Phone number must be in Georgian format: +995XXXXXXXXX.',
            'phone.unique' => 'This phone number is already registered.'
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

    public function login(Request $request)
    {
        return view("auth.login");
    }

    public function dashboard(Request $request)
    {
        return view("dashboard");
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => [
                'required',
                'regex:/^\+995[5-9][0-9]{8}$/',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'phone.regex' => 'Phone number must be in Georgian format: +995XXXXXXXXX.',
            'phone.unique' => 'This phone number is already registered.',
        ]);

        $user->update($request->only(['name', 'surname', 'phone', 'email']));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

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