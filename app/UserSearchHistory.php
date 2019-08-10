<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSearchHistory extends Model
{
    protected $fillable = [
        'user_id',
        'search'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
