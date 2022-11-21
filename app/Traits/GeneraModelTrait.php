<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait GeneraModelTrait
{
    protected static function bootGeneraModelTrait()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
