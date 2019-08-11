<?php

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/validate-token', function () {
    return ['data' => 'Token is valid'];
})->middleware('auth:api');


Route::get('/search', function (Request $request){
    $endpoint = 'https://api.giphy.com/v1/gifs/search';
    $giphy_public_key = 'w3jMSakVZZAqtf1M2H3yLLpxoSCURnPy';

    $search_query = $request->query('q');

    if (!$search_query) {
       return '';
    }
    $client = new \GuzzleHttp\Client();
    $response =  $client->request('GET', $endpoint, [
        'query' => [
            'api_key' => $giphy_public_key,
            'q' => $search_query
        ]
    ]);

    $statusCode = $response->getStatusCode();
    $content = $response->getBody()->getContents();
    $content = json_decode($content)->data;
    return response()->json($content);
});

Route::get('/private-search', 'SearchController@search')->middleware('auth:api');


Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');
Route::post('/logout', 'API\UserController@logout')->middleware('auth:api');;


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user/history', 'API\UserController@userHistory');
    Route::get('/user/favorites', 'API\UserController@userFavorites');
    Route::post('/user/favorites/{id}', 'API\UserController@toggleFavorites');
});
