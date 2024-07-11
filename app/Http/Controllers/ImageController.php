<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    //
    public function store(Request $request){

        $image = $request->file('file');

        $imageName = Str::uuid() . "." . $image->extension();

        //read and resize image with intervention image
        $manager = new ImageManager(new Driver());
        $serverImage = $manager->read($image);
        $serverImage->resize(1000,1000);

        //store image in uploads folder

        $imagePath = public_path('uploads') . '/' . $imageName;
        $serverImage->save($imagePath);

        return response()->json(['image' => $imageName]);
    }
}
