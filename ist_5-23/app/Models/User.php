<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Поля, доступные для массового заполнения.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'birth_date',
        'city',
        'bio',
        'avatar',
        'is_subcribed',
        'telegram',
    ];

    /**
     * Поля, скрываемые при сериализации.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Приведение типов.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password'          => 'hashed',
        'is_subcribed'      => 'boolean',
    ];
}