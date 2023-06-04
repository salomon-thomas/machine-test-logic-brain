<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $skip = $request->query('skip', 0);
        $limit = $request->query('limit', 10);

        $blogs = Blogs::skip($skip)->take($limit)->get();

        return response()->json($blogs, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $request['user_id']=Auth::user()->id;
        $blog = Blogs::create($request->all());

        return response()->json(['message' => 'Blog created successfully.','data'=>$blog], 201);
    }

    public function show($id)
    {
        $blog = Blogs::findOrFail($id);

        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
        ]);
        $blog = Blogs::findOrFail($id);
        $blog->update($request->all());

        return response()->json(['message' => 'Blog updated successfully.',"data"=>$blog]);
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
