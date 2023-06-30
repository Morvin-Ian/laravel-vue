<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('category', 'author')->get();
        
        
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
        $posts = $category->posts;
        
        return view('category',[
            'posts'=>$posts
        ]);
    }

    public function author(User $user)
    {
        $posts = $user->posts;
        
        return view('category',[
            'posts'=>$posts
        ]);
    }
    
}
