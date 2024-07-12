<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->get();
        return view('users.userprofile', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();

        $newrecord = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
        ]);

        try {
            // Start a transaction
            DB::beginTransaction();

            // Update user's name
            $user = User::find($userId);
            if ($user) {
                $user->name = $newrecord['name'];
                $user->save();
            }

            // Update user's profile
            $profile = Profile::updateOrCreate(
                ['user_id' => $userId],
                [
                    'bio' => $newrecord['bio'],
                    'birthdate' => $newrecord['birthdate'],
                    'location' => $newrecord['location']
                ]
            );

            // Commit the transaction
            DB::commit();

            // Success message
            return redirect()->route('profile');
        } catch (\Exception $e) {
            // Roll back the transaction on error
            DB::rollback();
            Log::error('Error updating tables: ' . $e->getMessage());
            // Error message
            return redirect()->back()->with('error', 'Error updating tables: ' . $e->getMessage());
        }
    }

    public function report()
    {
        return view('users.reports');
    }
}
