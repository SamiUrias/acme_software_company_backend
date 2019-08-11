<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFavoritesController extends Controller
{
    public static function additionalData($gifId){
        $endpoint = 'https://api.giphy.com/v1/gifs/' . $gifId;
        $giphy_public_key = 'w3jMSakVZZAqtf1M2H3yLLpxoSCURnPy';


        $client = new \GuzzleHttp\Client();
        $response =  $client->request('GET', $endpoint, [
            'query' => [
                'api_key' => $giphy_public_key,
            ]
        ]);

        $content = $response->getBody()->getContents();
        $content = json_decode($content)->data;
        return $content;
    }
}
