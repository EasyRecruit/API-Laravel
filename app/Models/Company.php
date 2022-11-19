<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $guarded = [
        'created_at',
        'update_at',
        'deleted_at',
    ];


    public function userAccount(){
        return $this->morphOne(User::class, 'authenticatable');
    }
}
