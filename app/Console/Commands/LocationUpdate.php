<?php

namespace App\Console\Commands;

use App\Models\CRM\LeadClientProject;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class LocationUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update location latitude  longitude';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $leads = LeadClientProject::where('location_update_status', '<>', 1)->where(function($query) {
            $query->where('latitude', null)->orWhere('latitude', '');
        })->where('lead_deleted_status', 0)->get();
        $clients = NewClient::where('location_update_status', '<>', 1)->where(function($query) {
            $query->where('latitude', null)->orWhere('latitude', '');
        })->where('deleted_status', 0)->get();
        $projects = NewProject::where('location_update_status', '<>', 1)->where(function($query) {
            $query->where('latitude', null)->orWhere('latitude', '');
        })->where('deleted_status', 0)->get();

        foreach($leads as $lead){
            if($lead->primaryTax){
                if($lead->primaryTax->google_address){
                    $location = self::location($lead->primaryTax->google_address);
                    $lead->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $lead->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $lead->location_update_status = 1;
                    $lead->save();
                }else if($lead->Code_Postal){
                    $location = self::location($lead->Code_Postal);
                    $lead->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $lead->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $lead->location_update_status = 1;
                    $lead->save();
                }
            }
        }
        foreach($clients as $client){
            if($client->primaryTax){
                if($client->primaryTax->google_address){
                    $location = self::location($client->primaryTax->google_address);
                    $client->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $client->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $client->location_update_status = 1;
                    $client->save();
                }else if($client->Code_Postal){
                    $location = self::location($client->Code_Postal);
                    $client->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $client->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $client->location_update_status = 1;
                    $client->save();
                }
            }
        }
        foreach($projects as $project){
            if($project->primaryTax){
                if($project->primaryTax->google_address){
                    $location = self::location($project->primaryTax->google_address);
                    $project->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $project->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $project->location_update_status = 1;
                    $project->save();
                }else if($project->Code_Postal){
                    $location = self::location($project->Code_Postal);
                    $project->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                    $project->longitude  = $location['status'] == 'success' ? $location['lng']:'';
                    $project->location_update_status = 1;
                    $project->save();
                }
            }
        }

        return 0;
    }
}
