<?php

use Illuminate\Http\UploadedFile;


if (!function_exists('profile')){
    function profile(){
        return auth()->user()->authenticatable;
    }
}

if (!function_exists('accountType')){
    function accountType(){
        return auth()->user()->authenticatable_type;
    }
}

if (!function_exists('uploadFileTo')){
    function uploadFileTo(UploadedFile $file, $path = 'default')
    {
        $path = $file->storePublicly($path, ['disk' => 'public_uploads']);
        return "uploads/$path";
    }
}
