<?php

namespace App\Exports;

use App\Models\CRM\LeadClientProject;
use Maatwebsite\Excel\Concerns\FromCollection;

class RingoverNumberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data = '';

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return $this->data;
    }
}
