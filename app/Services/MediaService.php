<?php


namespace App\Services;


class MediaService
{
    public function storePdf($owner, $file){
        $owner->addMedia($file)->toMediaCollection('cv');
    }
}
