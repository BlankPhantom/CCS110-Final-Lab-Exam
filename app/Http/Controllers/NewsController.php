<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Session;


class NewsController extends Controller
{
        // Show the blog creation form along with all blog posts
        public function create()
        {
       
            $news = News::with('user')->latest()->get();
            
            // Pass the blogs to the dashboard view
            return view('dashboard', compact('news'));
        }
    
    
        // Store the new blog post
        public function store_news(Request $request)
        {
            // Validate the input data
            $validated = $request->validate([
                'headline' => 'required|min:10',
                'content' => 'required|min:100',
                'date_published' => 'required|date',

            ]);
    
            // Create a new blog post and associate it with the authenticated user
            $news = new News();
            $news->headline = $request->headline;
            $news->content = $request->content;
            $news->author = $request->author;
            $news->date_published = $request->date_published;
            $news->user_id = auth()->id();
            $news->save();
    
            // Flash a success message
            Session::flash('success', 'Post successfully created!');
    
            // Redirect to the dashboard, which will now display all posts including the new one
            return redirect()->route('dashboard');
        }
}
