<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rule;
// use Illuminate\Validation\Rules\Password;

// class AuthController extends Controller
// {
//     public function index()
//     {
//         return view('auth.login');
//     }

//     public function create()
//     {
//         return view('auth.signup');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => ['required', 'min:8', Rule::unique('users', 'name')],
//             'email' => ['required', 'email', Rule::unique('users', 'email')],
//             'password' => [
//                 'required',
//                 'confirmed',
//                 Password::min(8)
//                     ->letters()
//                     ->mixedCase()
//                     ->numbers()
//                     ->symbols()
//                     ->uncompromised()
//             ],
//         ]);

//         $validated['password'] = Hash::make($validated['password']);
//         $user = User::create($validated);

//         $user->sendEmailVerificationNotification();

//         return redirect()->route('verification.notice');
//     }
// }

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function create()
    {
        return view('auth.signup');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        $token = Str::random(60);

        // Ensure the token is unique
        while (User::where('email_verification_token', $token)->exists()) {
            $token = Str::random(60);
        }

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'email_verification_token' => $token,
            ]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Check if unique constraint violation (MySQL)
                return back()->withErrors(['email' => 'Email is already in use.']);
            } else {
                return back()->withError('Failed to create user. Please try again later.');
            }
        }

        $this->sendVerificationEmail($user);

        return redirect()->route('verify-email')->with('email', $user->email);
    }

    protected function sendVerificationEmail($user)
    {
        $token = $user->email_verification_token;
        $email = $user->email;

        Mail::send('auth.emails.verify', ['token' => $token, 'user' => $user], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Verify Your Email Address');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        auth()->login($user);

        return redirect()->route('additionals');
    }

    protected function resendVerificationEmail(Request $request)
    {

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->email_verification_token;
        $email = $user->email;

        Mail::send('auth.emails.verify', ['token' => $token, 'user' => $user], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Verify Your Email Address');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });


        return redirect()->route('verify-email')->with('success', 'Verification email has been re-sent.');
    }

    public function process(Request $request) // Login Process
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/home');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout successful');
    }
}
