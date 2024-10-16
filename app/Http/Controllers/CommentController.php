<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId) {
        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);
        return response()->json($comment);
    }

    public function index(Request $request, $postId) {
        
        $comments = Comment::where('post_id', $postId)->with('user')->get();

        return response()->json($comments);
    }
    
}
