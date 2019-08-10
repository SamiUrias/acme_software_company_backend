<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;


Route::get('/{any?}', 'SinglePageApplication@index')->where('any', '.*');
//Route::get('/', function (Request $request) {
////    dd($request->fullUrl());
//    $endpoint = 'https://api.giphy.com/v1/gifs/search';
//    $giphy_public_key = 'w3jMSakVZZAqtf1M2H3yLLpxoSCURnPy';
//    $content = null;
//    $search_query = $request->query('query');
//
//    if ($search_query) {
//        $client = new \GuzzleHttp\Client();
//        $response =  $client->request('GET', $endpoint, [
//            'query' => [
//                'api_key' => $giphy_public_key,
//                'q' => $search_query
//            ]
//        ]);
//
//        $statusCode = $response->getStatusCode();
//        $content = $response->getBody()->getContents();
//        $content = json_decode($content)->data;
//    }
//
//    return view('welcome', ['gifs' => $content, 'query'=>$search_query]);
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
