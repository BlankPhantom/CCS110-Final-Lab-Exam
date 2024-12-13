<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    // Show the blog creation form along with all blog posts
    public function create()
    {
   
        $blogs = Blogs::with('user')->get();
        
        // Pass the blogs to the dashboard view
        return view('dashboard', compact('blogs'));
    }


    // Store the new blog post
    public function store_blogpost(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|min:10',
            'content' => 'required|min:100',
        ]);

        // Create a new blog post and associate it with the authenticated user
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->user_id = auth()->id();
        $blog->save();

        // Flash a success message
        Session::flash('success', 'Post successfully created!');

        // Redirect to the dashboard, which will now display all posts including the new one
        return redirect()->route('create-post');
    }
}
