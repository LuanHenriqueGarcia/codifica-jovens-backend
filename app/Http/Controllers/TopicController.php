<?php
namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return Topic::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $topic = Topic::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        return response()->json($topic, 201);
    }

    public function show($id)
    {
        $topic = Topic::with('replies')->findOrFail($id);
        return response()->json($topic);
    }
}
