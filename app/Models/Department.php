<?php

namespace App\Models;

use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use HasFactory, SoftDeletes, GeneraModelTrait;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
