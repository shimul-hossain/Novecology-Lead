<?php

namespace App\Exports;

use App\Models\CRM\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class CheckExport implements FromCollection
{
    public $data = '';
    public $status = '';


    public function __construct($data, $status)
    {
        $this->data = $data;
        $this->status = $status;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->data === 'all'){
            
            return Lead::where('status', $this->status)->orderBy('id', 'desc')->get();
        }
        else{
            return Lead::findMany($this->status);
        }
    }
}
