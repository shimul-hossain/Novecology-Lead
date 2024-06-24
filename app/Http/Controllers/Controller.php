<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function location($address){ 
        if(!$address){
            $response['status'] = 'failed';
            return $response;
        }
        $apiKey = 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E';
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';

        $client = new Client();
        $response = $client->get($url, [
            'query' => [
                'address' => $address,
                'components' => 'country:FR',
                'key' => $apiKey
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $response = [];
        if ($data['status'] === 'OK') {
            $response['status'] = 'success';
            $response['lat'] = $data['results'][0]['geometry']['location']['lat'];
            $response['lng'] = $data['results'][0]['geometry']['location']['lng'];
            // return response()->json(['lat' => $lat, 'lng' => $lng]);
        }else{
            $response['status'] = 'failed';
        }

        // return response()->json(['error' => 'Failed to get coordinates for the given address.'], 400);

        return $response;
    }
}
