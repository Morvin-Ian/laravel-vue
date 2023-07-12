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


    public function categories()
    {
        $categories = Category::all();
        return response($categories);
    }

    public function tags()
    {
        $tags = Tag::all();
        return response($tags);
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

    public function tag(Tag $tag)
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

    public function create_post(Request $request)  
    {
                    
            $fields = $request->validate([
                'title'=>['required', 'min:3'],
                'body' => ['required', 'min:10'],
                'category_id' => ['required'],
                'user_id'=> ['required'],
                'slug'=> ['required']
    
            ]);

            $post = Post::create($fields);
            $existing_tags = Tag::all();
            $tags = $request["tags"];
            $array = explode(",", $tags);

            foreach ($array as $arr) {
                $tagExists = false;
            
                foreach ($existing_tags as $existing_tag) {
                    if (trim($arr) === $existing_tag->name) {
                        $tagExists = true;
                        $existing_tag->posts()->attach($post);        
                        break; 
                    }
                }
            
                if (!$tagExists) {
                    $tag = Tag::create([
                        'name' => trim($arr)
                    ]);
                    $tag->posts()->attach($post);
                }
            }
            return redirect('/');
        }




    
}
