<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserSearchHistory;
use App\Http\Controllers\UserFavoritesController;

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

    public function favorites(){
        return $this->hasMany(UserFavorites::class);
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

    public function getFavorites() {

        $favoritesArray = UserFavorites::where('user_id', $this->id)->get();
        foreach ($favoritesArray as $index => $favoriteGif) {
            $favoritesArray[$index]['data'] = UserFavoritesController::additionalData($favoriteGif->favorite_id);
        }
        return $favoritesArray;
    }

    public function addFavorite($favorite_id){
        if ((UserFavorites::where('favorite_id', $favorite_id)->where('user_id', $this->id)->count() == 0) ) {
            return UserFavorites::create([
                'user_id' => $this->id,
                'favorite_id' => $favorite_id,
            ]);
        }
    }

    public function deleteFavorite($favorite_id){
        return UserFavorites::where('favorite_id', $favorite_id)->where('user_id', $this->id)->delete();
    }

    public function toggleFavorite($favorite_id) {
        if ((UserFavorites::where('favorite_id', $favorite_id)->where('user_id', $this->id)->count() == 0) ) {
           return $this->addFavorite($favorite_id);

        } else {
            return $this->deleteFavorite($favorite_id);
        }
    }
}
