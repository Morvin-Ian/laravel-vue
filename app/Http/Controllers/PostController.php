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
        $posts = Post::latest();
        
        if (request('search')){
            $posts
                ->where('title', 'like', '%'.request('search').'%')
                ->orwhere('body', 'like', '%'.request('search').'%')
                ->orwhere('slug', 'like', '%'.request('search').'%');
        }
        
        return view('posts',[
            'posts'=>$posts->get()
        ]);
    }

    public function show(Post $post)
    {
        
        return view('post',[
            'post'=>$post
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
