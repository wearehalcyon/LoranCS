<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller{
    public function post($slug){
        $post = Post::where([
            'slug' => $slug
        ])->first();
        dd($post);
    }
}
