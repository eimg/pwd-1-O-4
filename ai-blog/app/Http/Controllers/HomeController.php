<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'comments'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('posts')->get();

        return view('home', compact('posts', 'categories'));
    }
}
