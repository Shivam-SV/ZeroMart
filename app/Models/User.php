<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];

    protected $dates = [
        'created_at'
    ];

    public static $validationRules = [
        'name' => 'required|max:50|alpha',
        'email' => 'required|email|max:100|unique:users,email',
        'password' => 'required|string|max:20|min:6|confirmed'
    ];

    public function verified()
    {
        return $this->email_verified_at != null;
    }

    public function touchVerified()
    {
        $this->email_verified_at = $this->freshTimestamp();
        return $this->save();
    }
}
