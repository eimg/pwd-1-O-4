<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $validated['user_id'] = Auth::id();

        Comment::create($validated);

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        if (!Gate::allows('delete', $comment)) {
            abort(403, 'Unauthorized action.');
        }
        
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
