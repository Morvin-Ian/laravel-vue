<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostControllerApi extends Controller
{
    public function posts()
    {
        $response = [];
        $posts = Post::all();
    
        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);
    
            $data = [
                "post" => $post,
                "category" => $category,
                "author" => $user
            ];
    
            $response[] = $data;
        }
    
        return response($response);
    }
    

    public function post(Post $post)
    {
        $category = Category::find($post->category_id);
        $user = User::find($post->user_id);

        $data = [
            "post"=>$post,
            "category"=> $category,
            "author"=> $user
            

        ];

        $response = [$data];

        return response($response);
       
    }
    

    public function category(Category $category)
    {
        $posts = $category->posts;

        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);


            $data = [
                "post"=>$post,
                "category"=> $category,
                "author"=> $user
                
            ];

            $response[] = $data;

        }
     
        return response($response);
    }

    public function tags(Tag $tag)
    {
        $posts = $tag->posts;
        return response($posts);
    }

    public function user(User $user)
    {
        $posts = $user->posts; 

        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);


            $data = [
                "post"=>$post,
                "category"=> $category,
                "author"=> $user
                

            ];

            $response[] = $data;
        }

     
        return response($response);
    }
}
