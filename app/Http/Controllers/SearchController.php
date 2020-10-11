<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function post()
    {
        $query = request('query');

        $posts = Post::where("title", "like", "%$query%")->latest()->paginate(3);

        return view('posts.index', compact('posts'));
    }
}
