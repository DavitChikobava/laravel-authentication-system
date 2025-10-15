<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'No account found with this email address.'
        ]);

        try {
            $token = Str::random(64);
            $email = $request->email;

            Log::info("Attempting to send reset email to: " . $email);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );

            Log::info("Token created successfully for: " . $email);

            try {
                Mail::send('emails.reset-password', ['token' => $token], function($message) use($email) {
                    $message->to($email)
                        ->subject('Reset Your Password');
                });
            } catch (\Swift_TransportException $e) {
                Log::error("Swift Transport Error: " . $e->getMessage());
                throw $e;
            } catch (\Exception $e) {
                Log::error("Mail Send Error: " . $e->getMessage());
                throw $e;
            }

            Log::info("Reset email sent successfully to: " . $email);

            return back()->with('status', 'Password reset link has been sent to your email!');

        } catch (\Exception $e) {
            Log::error('Password Reset Email Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Unable to send password reset link. Error: ' . $e->getMessage()]);
        }
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.'
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$tokenData) {
            return back()->withErrors(['email' => 'Invalid token.']);
        }

        if (Carbon::parse($tokenData->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
            return back()->withErrors(['email' => 'Password reset link has expired.']);
        }

        $user = User::where('email', $tokenData->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $tokenData->email)->delete();

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully!');
    }
}