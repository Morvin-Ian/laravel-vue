<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function getPosts()
    {
        return Post::latest()->filter()->paginate(5);

    }


    public function index()
    {
                
        return view('posts',[
            'posts'=>$this->getPosts()
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
