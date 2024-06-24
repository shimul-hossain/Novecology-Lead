<?php

namespace App\Imports;

use App\Models\NewLead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewLeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NewLead([ 
            'heating_type'          => $row['heating_type'],
            'owner'                 => $row['owner'],
            'house_over_15_years'   => $row['house_over_15_years'],
            'email'                 => $row['email'], 
            'first_name'            => $row['first_name'], 
            'postal_code'           => $row['postal_code'],
            'phone'                 => $row['phone'],
            'date'                  => $row['date'],
            'duplicate_analysis'    => $row['duplicate_analysis'],
            'department'            => $row['department'],
            'zone'                  => $row['zone'],
            'management'            => $row['management'],
            'transfer_office_17'    => $row['transfer_office_17'], 
            'company_id'            => 10,
        ]);
    }
}
