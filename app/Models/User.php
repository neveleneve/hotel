<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function saldo() {
        return $this->hasOne(Saldo::class);
    }

    public function topup() {
        return $this->hasMany(TopUp::class);
    }

    public function ownReff() {
        return $this->hasOne(OwnRefferal::class);
    }

    public function reffBy() {
        return $this->hasOne(RefferedBy::class);
    }
}
