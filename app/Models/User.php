<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'document',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getIsAdminAttribute()
    {
        return $this->role_id === \App\Models\Role::ADMIN;
    }


    // --- Relationships --- //

    /**
     * Obtiene el role del usuario
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Devuelve las direcciones asociadas al usuario
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    
    /**
     * Regresa los pedidos del usuario
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Regresa _las tarjetas_ del usuario
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Obtiene las 'questions' del usuario
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Obtiene los 'rates' hechos por el usuario
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
