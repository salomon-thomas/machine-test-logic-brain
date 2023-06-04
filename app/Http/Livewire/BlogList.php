<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    public $selectedBlog;

    public function render()
    {
        $blogs = Blogs::latest()->paginate(4);

        return view('livewire.blog-list', compact('blogs'));
    }

    public function delete()
    {
        $blog = Blogs::findOrFail($this->selectedBlog);

        // Perform the delete action
        $blog->delete();

        // Redirect to a success page or perform additional actions as needed
        session()->flash('success', 'Blog deleted successfully.');
    }
}
