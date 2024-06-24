<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getHeader(){
        return $this->belongsTo(LeadHeader::class, 'header_id', 'id');
    }
    public function getClientHeader(){
        return $this->belongsTo(ClientHeader::class, 'header_id', 'id');
    }

    public function getProjectHeader(){
        return $this->belongsTo(ProjectHeader::class, 'header_id', 'id');
    }
    
}
