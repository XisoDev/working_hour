<?php

namespace XisoDev\WorkingHours\Test\Models;

use Illuminate\Database\Eloquent\Model;
use XisoDev\WorkingHours\Traits\HasSchedule;

class User extends Model
{
    use HasSchedule;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
