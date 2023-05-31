<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, Blogs $blog)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comments();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->user()->id; // Assign the authenticated user's ID
        $blog->comments()->save($comment);

        return redirect()->route('blogs.show', $blog)->with('success', 'Comment added successfully');
    }
}
