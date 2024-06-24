<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DefaultExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array 
    {
        return $this->header; 
    }
    public $header = '';
    public $info = '';
    public function __construct($header,$info)
    {
        $this->header = $header;
        $this->info = $info;
    }

    public function collection()
    {  
        return $this->info;
    }
}
