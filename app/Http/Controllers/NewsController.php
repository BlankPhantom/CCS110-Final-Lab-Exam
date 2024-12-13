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
    
        public function search(Request $request)
        {
            $query = News::query();

            // Filter by headline if provided
            if ($request->filled('headline')) {
                $query->where('headline', 'LIKE', '%' . $request->headline . '%');
            }

            // Filter by author if provided
            if ($request->filled('author')) {
                $query->where('author', 'LIKE', '%' . $request->author . '%');
            }

            // Filter by date if provided
            if ($request->filled('date')) {
                $query->whereDate('date_published', $request->date);
            }

            $news = $query->latest()->get();

            // Return a view with the search results
            return view('search-results', compact('news'));
        }
        // Store the new blog post
        public function store_news(Request $request)
        {
            // Validate the input data
            $validated = $request->validate([
                'headline' => 'required|min:10',
                'content' => 'required|min:100|max:65535',
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

        public function edit($id)
        {
            $news = News::findOrFail($id); // Fetch the news post by ID
            return view('news.edit', compact('news')); // Pass it to the edit view
        }

        public function update(Request $request, $id)
        {
            // Validate the input data
            $validated = $request->validate([
                'headline' => 'required|min:10',
                'content' => 'required|min:100',
                'date_published' => 'required|date',
            ]);

            // Find the news post and update it
            $news = News::findOrFail($id);
            $news->headline = $request->headline;
            $news->content = $request->content;
            $news->date_published = $request->date_published;
            $news->save();

            // Redirect back with a success message
            return redirect()->route('dashboard')->with('success', 'News post updated successfully.');
        }

        public function destroy($id)
        {
            $news = News::findOrFail($id); // Fetch the news post by ID
            $news->delete(); // Delete the post

            // Redirect back with a success message
            return redirect()->route('dashboard')->with('success', 'News post deleted successfully.');
        }
}
