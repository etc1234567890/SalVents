<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    public function showRequestForm($email)
    {
        return view('auth.reset-password', ['email' => $email]);
    }

    public function showRequestNull()
    {
        return view('auth.reset-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send('auth.emails.reset', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showResetForm($email, $token)
    {
        return view('auth.change-password', ['token' => $token, 'email' => $email]);
    }

    public function reset(Request $request)
    {
        try {
            $newpass = $request->validate([
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
                'token' => 'required'
            ]);

            $user = User::where('email', $newpass['email'])->first();
            $user->password = Hash::make($newpass['password']);
            $user->save();

            DB::table('password_resets')->where('email', $newpass['email'])->delete();

            return redirect()->route('home')->with('status', 'Your password has been reset!');
        } catch (\Exception $e) {

            // Redirect back with an error message
            return back()->withErrors(['error' => 'An error occurred while resetting your password. Please try again later.']);
        }
    }
}
