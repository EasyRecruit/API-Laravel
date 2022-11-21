<?php

namespace App\Models;

use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Worker extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, GeneraModelTrait;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];
}
