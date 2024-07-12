<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    public function index(User $user)
    {   
        //get user post to show
        $posts = Post::where('user_id', $user->id)->paginate('3');

        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts,
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
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);

        
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $image_path = public_path('uploads/' . $post->image);
        if(File::exists($image_path)){
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth()->user());
    }
}
