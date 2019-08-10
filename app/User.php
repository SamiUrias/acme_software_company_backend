<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserSearchHistory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
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

    public function searchHistory(){
        return $this->hasMany(UserSearchHistory::class);
    }

    public function addSearchHistory($search)
    {
        return UserSearchHistory::create([
            'user_id' => $this->id,
            'search' => $search,
        ]);
    }

    public function getHistory(){
        return UserSearchHistory::where('user_id', $this->id)->orderBy('id', 'desc')->get();
    }
}
