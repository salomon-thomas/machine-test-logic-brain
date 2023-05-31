<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blogs::all();

        return response()->json($blogs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = Blogs::create($request->all());

        return response()->json($blog, 201);
    }

    public function show($id)
    {
        $blog = Blogs::findOrFail($id);

        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = Blogs::findOrFail($id);
        $blog->update($request->all());

        return response()->json($blog);
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
