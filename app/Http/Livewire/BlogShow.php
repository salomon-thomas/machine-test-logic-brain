<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use App\Models\Comments;
use Livewire\Component;

class BlogShow extends Component
{
    public $blog;
    public $content;

    protected $rules = [
        'content' => 'required',
    ];

    public function mount(Blogs $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.blog-show', [
            'comments' => $this->blog->comments()->with('user')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();

        $comment = new Comments();
        $comment->content = $this->content;
        if (auth()->check()) {
            $comment->user_id = auth()->user()->id;
        } else {
            $comment->user_id = null;
        }        
        $this->blog->comments()->save($comment);

        $this->content = ''; // Clear the input field

        session()->flash('success', 'Comment added successfully');
    }
}
