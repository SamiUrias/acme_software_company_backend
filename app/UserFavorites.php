<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFavorites extends Model
{
    protected $fillable = [
        'user_id',
        'favorite_id'
    ];
}
