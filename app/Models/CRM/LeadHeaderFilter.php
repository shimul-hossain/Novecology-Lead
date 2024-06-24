<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getHeader(){
        return $this->belongsTo(LeadHeader::class, 'lead_header_id', 'id');
    }
}
