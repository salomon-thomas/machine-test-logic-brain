<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{

    public function create()
    {
        return view('blog_views.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    
        $blog = new Blogs();
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->user_id = auth()->user()->id; // Assign the authenticated user's ID
        $blog->save();
    
        return redirect()->route('blogs.create')->with('success', 'Blog created successfully');
    }    

    public function show(Blogs $blog)
    {
        return view('blog_views.show', compact('blog'));
    }

    public function edit(Blogs $blog)
    {
        return view('blog_views.edit', compact('blog'));
    }

    public function update(Request $request, Blogs $blog)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->save();

        return back()->with('success', 'Blog updated successfully');
    }

    public function destroy(Blogs $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
