<?php

namespace App\Exports;

use App\Models\CRM\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public $id  = '';

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection()
    {
 
            
            return Client::findMany($this->id);
       
    }
}
