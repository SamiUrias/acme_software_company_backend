<?php

use Illuminate\Http\Request;

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
    $content = $response->getBody();
    return $content;
    return 'Hello World';
});
