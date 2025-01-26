<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'role', 'email', 'password'];
}
