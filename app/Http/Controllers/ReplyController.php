<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $topicId)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $topic = Topic::findOrFail($topicId);

        $reply = $topic->replies()->create([
            'user_id' => auth()->id(),
            'content' => $validatedData['content'],
        ]);

        return response()->json($reply, 201);
    }
}
