<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public const ROLE_ADMIN = 0;
    public const ROLE_USER = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'role_id','phone_number','address'
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
    /**
     * Relation with model orderdetails
     *
     * @retun mix
     */
    public function orders() {
        return $this->hasMany('App\Models\Orders', 'user_id', 'id');
    }
    /**
     * Relation with model orderdetails
     *
     * @retun mix
     */
    public function warehousing() {
        return $this->hasMany('App\Models\Warehousing', 'user_id', 'id');
    }
    public function getAllUsers(){
        $listUsers = $this->all();
        return $listUsers;
    }
}
