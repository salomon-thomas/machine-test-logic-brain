<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;
use App\Models\Blogs;
use App\Models\Role;
use App\Models\User;
use SimpleXMLElement;
use Illuminate\Support\Facades\Http;

class ImportBlogsFromRSS extends Command
{
    protected $signature = 'blogs:import';

    protected $description = 'Import blogs from RSS feed';

    public function handle()
    {
        // Fetch the RSS feed
        $response = Http::get('https://feeds.bbci.co.uk/news/rss.xml');

        if ($response->successful()) {
            $xml = new SimpleXMLElement($response->body());

            // Process the RSS feed and create new blogs
            foreach ($xml->channel->item as $item) {
                $title = $item->title;
                $content = $item->description;

                // Create a new blog
                $blog = new Blogs();
                $blog->title = $title;
                $blog->content = $content;
                $blog->user_id = User::where('roles_id', Role::where('name', 'admin')->pluck('id')->first())->pluck('id')->first();
                $blog->save();
            }

            $this->info('Blogs imported successfully.');
        } else {
            $this->error('Failed to fetch RSS feed.');
        }
    }
}
