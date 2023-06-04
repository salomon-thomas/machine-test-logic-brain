<?php

namespace App\Http\Middleware;

use App\Models\Blogs;
use Closure;

class CheckOwnership
{
    public function handle($request, Closure $next)
    {
        $blogId = $request->route('id'); // Assuming the blog ID is passed in the route parameter 'id'
        $blog = Blogs::find($blogId);

        if (!$blog || $blog->user_id !== auth()->id()) {
            return response()->json(['error' => 'You have no authority over this post'], 403);
        }
        return $next($request);
    }
}
