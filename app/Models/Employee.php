<?php

namespace App\Models;

use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, GeneraModelTrait;


    protected static function bootGeneraModelTrait()
    {
        parent::boot();
        static::deleting(function ($model) {
//            $model->clearMediaCollection('cv');
        });
    }

    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];
}
