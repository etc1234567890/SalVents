<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('is_public', 1)
            ->orderBy('created_at', 'desc')
            ->with('user.profile'); // Eager load user and user's profile


        if ($request->has('search') && $request->has('category')) {
            $search = $request->input('search');
            $category = $request->input('category');

            // Apply filters based on the category
            if ($category === 'Username') {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            } elseif ($category === 'Title') {
                $query->where('title', 'like', "%{$search}%");
            } elseif ($category === 'Tags') {
                $query->where('tags', 'like', "%{$search}%");
            } else {
                // If no specific category is chosen, search in multiple fields
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }
        }

        $posts = $query->paginate(10);

        return view('journals.journals', compact('posts'));
    }

    public function show($id)
    {
        $posts = Post::where('id', $id)
            ->with('user.profile')
            ->firstOrFail();
        return view('journals.content', compact('posts'));
    }

    public function store(Request $request)
    {
        $contents = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'content' => ['required', 'string'],
            'tag' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9]+$/'],
            'is_public' => ['required', 'boolean'],
            'emotion' => ['required', 'string'],
        ]);

        $tagsString = $contents['tag'];
        $tagsArray = explode(',', $tagsString);

        $tagsArray = array_map(function ($tag) {
            return '#' . ltrim($tag, '#'); // Ensure no duplicate # if the tag already has one
        }, $tagsArray);

        $formattedTags = implode(',', $tagsArray);

        try {
            $post = Post::create([
                'title' => $contents['title'],
                'content' => $contents['content'],
                'tag' => $formattedTags,
                'is_public' => $contents['is_public'],
                'emotion' => $contents['emotion'],
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create post. Please try again.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request if necessary

        $post = Post::findOrFail($id);
        $post->is_public = (bool) $request->status; // Convert status to boolean
        $post->save();

        return response()->json(['message' => 'Post status updated successfully']);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404, 'Post not found');
        }

        // Delete the post
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }
}
