<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'comment' => 'required|max:254'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('message', 'Comentario agregado correctamente');
    }
}
