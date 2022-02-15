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

    public function feedback(){
        $this -> belongsToMany(Feedback::class);
    }
    public function save(array $options = array()) {
        if(isset($this->remember_token))
            unset($this->remember_token);

        return parent::save($options);
    }

    protected $fillable = [
        'First_Name',
        'Last_Name',
        'provider_id',
        'email',
        'Password',
        'Gender',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
