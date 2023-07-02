<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;

class FileService
{

    /**
     * @param $file
     * @return string
     */
    public static function uploadFile($file): string
    {
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $data['pic'] = $filename;
        return $filename;
    }

    /**
     * @param $image_name
     */
    public static function removeFile(string $image_name)
    {
        $image_path = public_path('images/'.$image_name);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

}