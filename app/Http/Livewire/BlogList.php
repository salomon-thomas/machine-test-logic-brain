<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    public function render()
    {
        $blogs = Blogs::latest()->paginate(4);

        return view('livewire.blog-list', compact('blogs'));
    }

    public function delete(Blogs $blog)
    {
        if (auth()->user()->id == $blog->user_id) {
            $blog->delete();
            session()->flash('success', 'Blog deleted successfully.');
        } else {
            session()->flash('error', 'You are not authorized to delete this blog.');
        }
    }
}
