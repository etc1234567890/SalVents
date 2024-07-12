<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Condition;
use App\Models\Report;
use App\Models\Event;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {
        $statistics = [
            'users' => User::count(),
            'events' => Event::count(),
            'reports' => Report::count(),
            'activeUsers' => User::where('last_login', '>=', Carbon::now()->subDays(30))->count(),
        ];

        $newUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))->get();

        // Fetch recently active users (e.g., users who logged in within the last 30 days)
        $recentActiveUsers = User::where('last_login', '>=', Carbon::now()->subDays(30))->get();

        return view('admin.dashboard', compact('statistics', 'newUsers', 'recentActiveUsers'));
    }

    public function user(Request $request)
    {
        $search = $request->query('search');

        $users = User::with('profile')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('id', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.user-management', compact('users'));
    }

    public function contents(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::with('user')
            ->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('tag', 'like', '%' . $search . '%')
                    ->orWhere('emotion', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('admin.content-management', compact('posts'));
    }

    public function comments(Request $request)
    {
        $search = $request->input('search');

        $comments = Comment::with('user')
            ->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('comment', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.comments-management', compact('comments'));
    }

    public function filedreports()
    {
        $reports = Report::all();
        return view('admin.reports-list', compact('reports'));
    }

    public function events()
    {
        $events = Event::all();
        return view('admin.events', compact('events'));
    }

    public function update($userid)
    {
        $user = User::where('id', $userid)
            ->with('profile')
            ->firstOrFail();

        return view('admin.edit-form', compact('user'));
    }

    public function adduser()
    {
        return view('admin.user-form');
    }

    //  Store New User
    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'role' => 'required|string',
            'verify' => 'required|boolean',
        ]);

        $newuser = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'role' => $user['role'],
        ]);

        if ($user['verify'] == 1) {
            $newuser->email_verified_at = now();
            $newuser->save();
        }

        return redirect()->route('user-list')->with('success', 'User created successfully.');
    }

    //  Edit User
    public function patch(Request $request)
    {
        // Validate the request data
        $userinfo = $request->validate([
            'uid' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'location' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'bio' => 'nullable|string|max:255',
            'verify' => 'required|boolean',
        ]);

        try {
            // Start a transaction
            DB::beginTransaction();

            // Find the user by ID
            $user = User::findOrFail($userinfo['uid']);

            // Updating User verification status
            if ($userinfo['verify'] == 1) {
                $user->email_verified_at = now();
            } else {
                $user->email_verified_at = null;
            }
            // Update user fields
            $user->name = $userinfo['name'];
            $user->email = $userinfo['email'];

            // Only hash and update the password if it has changed
            if ($user->password !== $userinfo['password']) {
                $user->password = bcrypt($userinfo['password']);
            }

            // Save the user
            $user->save();

            // Update or create profile associated with the user
            $profile = Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'location' => $userinfo['location'] ?? null,
                    'birthdate' => $userinfo['birthdate'] ?? null,
                    'bio' => $userinfo['bio'] ?? null,
                ]
            );

            // Commit the transaction
            DB::commit();

            // Redirect back with a success message
            return redirect()->route('user-list')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }
    public function destroy(Request $request)
    {
        $userid = $request->validate([
            'userId' => 'required',
        ]);

        $id = $userid['userId'];
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function destroypost(Request $request)
    {
        $postid = $request->validate([
            'userId' => 'required',
        ]);

        $id = $postid['userId'];
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    public function destroycomment(Request $request)
    {
        $commentid = $request->validate([
            'userId' => 'required',
        ]);

        $id = $commentid['userId'];
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function destroyreport(Request $request)
    {
        $reportid = $request->validate([
            'userId' => 'required',
        ]);

        $id = $reportid['userId'];
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function destroyevent(Request $request)
    {
        $eventid = $request->validate([
            'userId' => 'required',
        ]);

        $id = $eventid['userId'];
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function destroycondition(Request $request)
    {
        $conditionId = $request->validate([
            'userId' => 'required',
        ]);

        $id = $conditionId['userId'];
        $condition = Condition::findOrFail($id);
        $condition->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function viewpost($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return view('admin.view-post', compact('post'));
    }

    public function viewcomment($id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();
        return view('admin.view-comment', compact('comment'));
    }

    public function event($id)
    {
        $events = Event::where('id', $id)->firstOrFail();
        return view('admin.edit-event', compact('events'));
    }

    public function change(Request $request)
    {
        $events = $request->validate([
            'id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'date' => 'required|date', // Ensure 'date' is a valid date format
            'start' => 'nullable|date_format:H:i',
            'end' => 'nullable|date_format:H:i|after:start',
        ]);

        // Find the event by its ID
        $event = Event::find($events['id']);

        if (!$event) {
            return abort(404, 'Event not found');
        }

        // Format start_time and end_time into datetime strings using the provided date
        $start_time = $events['start'] ? $events['date'] . ' ' . $events['start'] . ':00' : null;
        $end_time = $events['end'] ? $events['date'] . ' ' . $events['end'] . ':00' : null;

        $event->update([
            'title' => $events['title'],
            'description' => $events['description'],
            'link' => $events['link'],
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        // Redirect back with success message
        return redirect()->route('manage-events')->with('success', 'Record updated successfully!');
    }

    public function addevent()
    {
        return view('admin.add-event');
    }

    public function new(Request $request)
    {
        $event = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'link' => 'nullable|url',
            'date' => 'required|date',
            'start' => 'nullable|date_format:H:i',
            'end' => 'nullable|date_format:H:i|after:start',
        ]);

        $start_time = $event['start'] ? $event['date'] . ' ' . $event['start'] . ':00' : null;
        $end_time = $event['end'] ? $event['date'] . ' ' . $event['end'] . ':00' : null;

        Event::create([
            'title' => $event['title'],
            'description' => $event['description'],
            'link' => $event['link'],
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return redirect()->route('manage-events')->with('success', 'Record saved successfully!');
    }

    public function condition()
    {
        $conditions = Condition::all();
        return view('admin.conditions', compact('conditions'));
    }

    public function formCondition()
    {
        return view('admin.add-conditions');
    }

    public function editCondition($id)
    {
        $condition = Condition::where('id', $id)->firstOrFail();
        return view('admin.edit-condition', compact('condition'));
    }

    public function newcondition(Request $request)
    {
        $condition = $request->validate([
            'condition' => 'required|string|max:255',
            'description' => 'required',
            'symptoms' => 'required',
            'practices' => 'required',
        ]);

        Condition::create([
            'con_name' => $condition['condition'],
            'con_description' => $condition['description'],
            'symptoms' => $condition['symptoms'],
            'health_practices' => $condition['practices'],
        ]);

        return redirect()->route('manage-conditions')->with('success', 'Record saved successfully!');
    }

    public function updatecon(Request $request)
    {
        $conditions = $request->validate([
            'id' => 'required|exists:conditions,id',
            'condition' => 'required|string|max:255',
            'description' => 'required',
            'symptoms' => 'required',
            'practices' => 'required',
        ]);

        $condition = Condition::find($conditions['id']);

        if (!$condition) {
            return abort(404, 'Event not found');
        }

        $condition->update([
            'con_name' => $conditions['condition'],
            'con_description' => $conditions['description'],
            'symptoms' => $conditions['symptoms'],
            'health_practices' => $conditions['practices'],
        ]);

        // Redirect back with success message
        return redirect()->route('manage-conditions')->with('success', 'Record updated successfully!');
    }
}
