<?php

namespace App\Models;

use App\Traits\GeneraModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, GeneraModelTrait;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];


    public function authAccount(){
        return $this->morphOne(User::class, 'authenticatable');
    }
}
