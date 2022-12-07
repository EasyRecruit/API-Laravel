<?php

namespace App\Models\Employee;

use App\Models\Employee;
use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

class Qualification extends Model
{
    use HasFactory, SoftDeletes, GeneraModelTrait, InteractsWithMedia;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->clearMediaCollection('attachments');
        });
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
