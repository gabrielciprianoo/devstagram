<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);
        $request->validate([
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:edit-profile,twitter'
            ]
        ]);

        if ($request->image) {
            $image = $request->file('image');

            $imageName = Str::uuid() . "." . $image->extension();

            //read and resize image with intervention image
            $manager = new ImageManager(new Driver());
            $serverImage = $manager->read($image);
            $serverImage->resize(500, 500);

            //store image in uploads folder

            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('posts.index', $user);
        
    }
}
