<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'account_person'    => 'object',
        'office_address'    => 'object',
        'delivery_address'  => 'object',
    ];

    /**
     * Get all of the quotes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
