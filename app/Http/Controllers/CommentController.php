<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::get();
        return response()->json(
            [
                'success' => true,
                'message' => "Comments data retrieved successfully",
                'data' => $comments
            ]
        );
    }
    public function show($id){
        $comment = Comment::with('post')->findOrFail($id);
         return response()->json([
            'success' => true,
            'message' => "Comment ID {$id}'s data fetched!",
            'data' => $comment
        ]);
    }
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'comment_text' => $request->comment_text,
            'comment_reactions' => $request->comment_reactions
        ]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Comment created successfully',
                'data' => $comment
            ]
        );
    }
}
