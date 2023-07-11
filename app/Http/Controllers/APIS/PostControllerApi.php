<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostControllerApi extends Controller
{
    public function posts(){
        $response = Post::all();
        return response($response);

    }
}
