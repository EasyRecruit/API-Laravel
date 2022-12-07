<?php

namespace App\Models;

use App\Models\Employee\Education;
use App\Models\Employee\Qualification;
use App\Models\Employee\Skill;
use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, GeneraModelTrait;


    protected static function boot()
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

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function qualifications(){
        return $this->hasMany(Qualification::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }
}
