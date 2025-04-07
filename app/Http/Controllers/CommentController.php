<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    public function store(Request $request, Note $note)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $note->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back()->with('message', 'Comment added!');
    }
}