<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'email', 'password'
    ];


    use HasFactory;
}
