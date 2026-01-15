<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private $name;
    // private $email;
    private $password;
    // private $remember_token;
    // private $email_verified_at;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'email',
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

    // Getter and Setter methods for each private attribute
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // public function getEmail()
    // {
    //     return $this->email;
    // }

    // public function setEmail($email)
    // {
    //     $this->email = $email;
    // }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // public function getRememberToken()
    // {
    //     return $this->remember_token;
    // }

    // public function setRememberToken($remember_token)
    // {
    //     $this->remember_token = $remember_token;
    // }

    // public function getEmailVerifiedAt()
    // {
    //     return $this->email_verified_at;
    // }

    // public function setEmailVerifiedAt($email_verified_at)
    // {
    //     $this->email_verified_at = $email_verified_at;
    // }
    
}
