<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return response()->json([
            'success' => true,
            'message' => "Posts data fetched!",
            'data' => $posts
        ]);
    }
    public function show($id){
        $post = Post::with('comments')->findOrFail($id);
         return response()->json([
            'success' => true,
            'message' => "Post ID {$id}'s data fetched!",
            'data' => $post
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = Post::create(
            [
                'post_title' => $request->post_title,
                'post_summary' => $request->post_summary
            ]

        );
        return response()->json(
            [
                'success' => true,
                'message' => 'Post created successfully',
                'data' => $post
            ]
        );
    }
}
