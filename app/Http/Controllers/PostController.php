<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('layouts.dashboard', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //request validation
        $request->validate([
            'title' => 'required|max:254',
            'description' => 'required',
            'image' => 'required'
        ]);

        //insert record in database
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index', auth()->user()->username);

        
    }
}
