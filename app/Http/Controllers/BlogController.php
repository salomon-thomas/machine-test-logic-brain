<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blogs::latest()->paginate(4);
        return view('blog_views.index', compact('blogs'));
    }

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

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
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

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blogs $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
    public function showImportForm()
    {
        return view('blog_views.import');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $request->file('csv_file');

        // Process the CSV file and create new blogs
        $csvFilePath = $file->getPathname();
        $csvData = array_map('str_getcsv', file($csvFilePath));dd($csvData);

        // Remove the header row if present
        if (count($csvData) > 0 && isset($csvData[0])) {
            unset($csvData[0]);
        }

        // Iterate over each row and create new blogs
        foreach ($csvData as $row) {
            $title = $row[0]; // Assuming the title is in the first column of the CSV
            $content = $row[1]; // Assuming the content is in the second column of the CSV

            // Create a new blog
            $blog = new Blogs();
            $blog->title = $title;
            $blog->content = $content;
            $blog->user_id = auth()->id(); // Set the user ID based on the logged-in user

            // Save the blog
            $blog->save();
        }

        // Redirect to a success page or perform additional actions as needed
        return redirect()->route('blogs.index')->with('success', 'Blogs imported successfully.');
    }
}
