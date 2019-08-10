<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //
    public function search(Request $request) {
        if($user = Auth::user()){
            $user->addSearchHistory($request->query('q'));
        }

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
    }
}
