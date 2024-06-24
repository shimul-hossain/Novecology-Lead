<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getHeader(){
        return $this->belongsTo(ClientHeader::class, 'client_header_id', 'id');
    }
}
