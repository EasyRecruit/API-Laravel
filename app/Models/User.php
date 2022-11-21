<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GeneraModelTrait;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, GeneraModelTrait;

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $morph_types = [
        'admin' => 'App\Models\Administrator',
        'company' => 'App\Models\Company'
    ];

    public function authenticatable(){
        return $this->morphTo();
    }

    public function authenticatableType() : Attribute{
        return new Attribute(
            get: fn($type) => array_search($type, $this->morph_types)
        );
    }
}
