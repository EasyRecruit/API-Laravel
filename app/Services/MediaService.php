<?php


namespace App\Services;


class MediaService
{
    public function storePdf($owner, $file){
//        $path = uploadFileTo($file, 'cv');
        $owner->addMedia($file)->toMediaCollection('cv');
    }
}
