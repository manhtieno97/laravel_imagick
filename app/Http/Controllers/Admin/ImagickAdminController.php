<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Imagick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagickAdminController extends Controller
{
    public function index()
    {
        //$data['items'] = Image::orderBy('id', 'desc')->paginate(20);
        return view('image');
    }
    public function postImage(Request $request){
        $name = '';
        $im = new \Imagick();
        $im->setFormat("gif");
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $contents = file_get_contents($file->getRealPath());
                $frame = new \Imagick();
                $frame->readImageBlob($contents);
                $frame->setImageDispose(2);
                $frame->setImageDelay(10);
                $im->addImage($frame);

            }
            $name = time().'.gif';
            //Storage::disk('local')->put('public/images/'.$name, $im->getImageBlob());
            $im->writeImages(public_path('storage/images/').$name, true);
        }

        return view('image',compact('name'));
    }
}
