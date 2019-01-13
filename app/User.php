<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'notifications'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Order()
    {
        return $this->hasMany('App\Order')->orderBy('created_at', 'ASC');
    }

    public function Subscription()
    {
        return $this->hasMany('App\Subscription')->orderBy('created_at', 'ASC');
    }

    public function Referrer()
    {
        return $this->hasMany('App\Coupon', 'referrer_id')->orderBy('created_at', 'ASC');
    }

    public function Coupon()
    {
        return $this->hasMany('App\Coupon', 'user_id')->orderBy('created_at', 'ASC');
    }
}
