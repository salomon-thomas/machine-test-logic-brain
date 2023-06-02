<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogImport extends Component
{
    use WithFileUploads;

    public $csvFile;

    public function render()
    {
        return view('livewire.blog-import');
    }

    public function import()
    {
        // Validate the uploaded file
        $this->validate([
            'csvFile' => 'required|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $this->csvFile;

        // Generate a unique file name
        $fileName = uniqid('import-', true) . '.' . $file->getClientOriginalExtension();

        // Store the file in the storage/app/public directory
        $file->storeAs('public', $fileName);

        // Get the file path
        $filePath = Storage::disk('public')->path($fileName);

        // Process the CSV file and create new blogs
        $csvData = array_map('str_getcsv', file($filePath));

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

        // Reset the form field
        $this->csvFile = null;

        // Delete the temporary file
        Storage::disk('public')->delete($fileName);

        // Redirect to a success page or perform additional actions as needed
        session()->flash('success', 'Blogs imported successfully.');
    }
}
