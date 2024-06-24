<?php

namespace App\Exports;

use App\Models\CRM\Client;
use App\Models\CRM\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadExport implements FromCollection
{
    public $status = '';


    public function __construct($status)
    {
        $this->status = $status;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->status === 'client'){
            
            return Client::all();
        }
        else{
            return Lead::where('status', $this->status)->get();
        }
    }
}
