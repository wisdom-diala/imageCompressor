<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompressImageController extends Controller
{
    public function compress(Request $request)
    {
        $this->validate($request, [
            'image_format' => ['required', 'string', 'max:5'],
            'image' => ['required', 'image']
        ]);

        # create image name with it's format (specify image saving path)
        $imageName = "compressed_images/" . Str::uuid() . $request->image_format;
        Image::make($request->image)->save($imageName, 20);
        return back()->withSuccess("Image compressed successfully. <a download href='/$imageName'>Click to download image</a>");
    }
}
