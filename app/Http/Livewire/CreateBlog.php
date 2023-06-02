<?php
namespace App\Http\Livewire;

use App\Models\Blogs;
use Livewire\Component;

class CreateBlog extends Component
{
    public $title;
    public $content;
    public $successMessage;

    public function render()
    {
        return view('livewire.create-blog');
    }
    public function dismissSuccessMessage()
    {
        $this->successMessage = null;
    }
    public function mount()
    {
        $this->listeners = ['dismissSuccessMessage'];
    }
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = new Blogs();
        $blog->title = $this->title;
        $blog->content = $this->content;
        $blog->user_id = auth()->user()->id;
        $blog->save();

        // Reset the form fields
        $this->reset();

        // Redirect or show success message
        $this->successMessage = 'Post created successfully.';
    }
}
