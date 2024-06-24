<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RingoverExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array 
    {
        return $this->header; 
    }

    public $export_data = '';
    public $header = '';

    public function __construct($export_data, $header)
    {
        $this->export_data = $export_data;
        $this->header = $header;
    }

    public function collection()
    {
        return $this->export_data;
    }
}
