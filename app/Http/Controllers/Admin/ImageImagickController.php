<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Imagick\MyImagick;
use App\Http\Controllers\Imagick\ImageImagick;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageImagickController extends Controller
{
    public function index()
    {
        //$data['items'] = Image::orderBy('id', 'desc')->paginate(20);
        return view('image_imagick');
    }
    public function postImage(Request $request){

        if(!empty($request->hasFile('images')) && !empty($request->type))
        {
            $name_new = '';
            $info = [];
            $image = $request->file('images');
            $name = time().'.'.$image->getClientOriginalExtension();
            $contents = file_get_contents($image->getRealPath());
            $output ='public/images/'.$name;
            try
            {
                $image = ImageImagick::factory($contents, $output);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                die;
            }
            switch ($request->type) {
                case 'edit_image':
                    if(!empty($request->gotham)){
                        $image->gotham();
                    }
                    if(!empty($request->rotate)){
                        $image->rotateImage($request->rotate_color,$request->rotate_number);
                    }
                    if(!empty($request->border)){
                        $image->border($request->border_color,$request->border_width,$request->border_height);
                    }
                    $image->output();
                    $name_new = $name;
                    break;
                case 'info':
                    $info = $image->info();
                    break;
                default:
                    break;
            }
            return view('image_imagick',compact(array('name_new','info')));
        }

    }

}
