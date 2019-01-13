<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $fillable = array('username', 'email', 'salt', 'password', 'display_name');

}
