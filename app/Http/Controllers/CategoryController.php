<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        $posts = $category->post()->latest()->paginate(6);

        return view('pages.posts.index', compact('posts', 'category'));
    }
}
