<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Note $note)
    {
        $user = Auth::user();

        $like = $note->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $note->likes()->create([
                'user_id' => $user->id
            ]);
        }

        return back();
    }
}