<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Method to store a new comment
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    // Method to store a reply to a comment
    public function replyStore(Request $request, $postId, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $parentComment = Comment::findOrFail($commentId);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'parent_id' => $parentComment->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    // Method to delete a comment
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Check if the authenticated user owns the comment
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

    // Method to delete a reply
    public function replyDestroy($replyId)
    {
        $reply = Comment::findOrFail($replyId);

        // Check if the authenticated user owns the reply
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $reply->delete();

        return back()->with('success', 'Reply deleted successfully.');
    }
}
