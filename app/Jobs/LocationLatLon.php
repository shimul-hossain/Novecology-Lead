<?php

namespace App\Jobs;

use App\Models\CRM\LeadClientProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels; 
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LocationLatLon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $lead_id = '';
    public $address = '';
    public function __construct($lead_id, $address)
    {
        $this->lead_id = $lead_id;
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lead = LeadClientProject::find($this->lead_id);
        Log::info('hosche toh');
        Log::info($this->lead_id);
        if($lead){
            $apiKey = 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E';
            $url = 'https://maps.googleapis.com/maps/api/geocode/json';
    
            $client = new Client();
            $response = $client->get($url, [
                'query' => [
                    'address' => $this->address,
                    'components' => 'country:FR',
                    'key' => $apiKey
                ]
            ]);
    
            $data = json_decode($response->getBody(), true);
            if ($data['status'] === 'OK') { 
                $lead->latitude = $data['results'][0]['geometry']['location']['lat'];
                $lead->longitude = $data['results'][0]['geometry']['location']['lng'];
                $lead->save();
            } 
        }
    }
}
