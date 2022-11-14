<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'hash'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoStoragePath() {
        return 'photos/' . $this->id;
    }

    public function profile() {
        return $this->hasOne(UserProfile::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function languages()
    {
        return $this->hasMany(ResumeLanguage::class);
    }

    public function skills()
    {
        return $this->hasOne(Skills::class);
    }
}
