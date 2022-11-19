<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrator extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];


    public function userAccount(){
        return $this->morphOne(User::class, 'authenticatable');
    }
}
