<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    public function headings(): array 
    {
        return $this->header; 
    }
    
    public $header = '';
    public $client_info = '';
    public function __construct($header,$client_info)
    {
        $this->header = $header;
        $this->client_info = $client_info;
    }

    public function collection()
    {
        return $this->client_info;
    }
}
