<?php

namespace App\Exports;

use App\Models\CRM\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyLead implements FromCollection
{
    public $data = '';
    public $status = '';
    public $company_id = '';

    public function __construct($data, $status, $company_id)
    {
        $this->company_id = $company_id;
        $this->data = $data;
        $this->status = $status;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->data === 'all'){
            
            return Lead::where('status', $this->status)->where('company_id', $this->company_id)->orderBy('id', 'desc')->get();
        }
        else{
            return Lead::findMany($this->status);
        }
    }
}
