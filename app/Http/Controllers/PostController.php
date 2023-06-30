<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        
        
        return view('posts',[
            'posts'=>$posts
        ]);
    }

    public function show(Post $post)
    {
        
        return view('post',[
            'posts'=>$post
        ]);
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category)->get();
        
        return view('category',[
            'posts'=>$posts
        ]);
    }
    
}
