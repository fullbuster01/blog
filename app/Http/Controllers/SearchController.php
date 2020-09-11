<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function posts(){
        $query = request('query');
        $posts = Post::where("title", "like", "%$query%")->latest()->paginate(10);
        return view('pages.posts.index',compact('posts'));
    }
}
