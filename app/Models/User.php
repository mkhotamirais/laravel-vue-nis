<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function infocats()
    {
        return $this->hasMany(Infocat::class);
    }

    public function infos()
    {
        return $this->hasMany(Info::class);
    }

    public function facilitycats()
    {
        return $this->hasMany(Facilitycat::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
