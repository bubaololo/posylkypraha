<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Exception;

use Storage;

class ArticleController extends Controller
{
    public function postsList() {
        $posts = Post::all();
        $posts = $posts->map(function ($post) {
            $imagePath = Storage::url($post->featured_image);
            return [
                'post' => $post,
                'imagePath' => $imagePath,
                'url' => env('APP_URL').'/'.$post->slug,
            ];
        });
        
        return view('post-list', [
            'posts' => $posts
        ]);
    
    
    
    
        $posts = $posts->map(function ($post) {
            $imagePath = Storage::url($post->featured_image);
            return [
                'post' => $post,
                'imagePath' => $imagePath,
            ];
        });
    

    }
    
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            $imagePath = Storage::url($post->featured_image);
            return view('post', [
                'post' => $post,
                'imagePath' => $imagePath,
            ]);
        }
        
        // No match was found
        abort(404);
    }
}
