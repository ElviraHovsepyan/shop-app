<?php

namespace App\Http\Services;

class FileService
{

    public static function uploadFile($file)
    {
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $data['pic']= $filename;
        return $filename;
    }

    public static function removeFile($image_name)
    {
        $image_path = public_path('images/'.$image_name);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

}