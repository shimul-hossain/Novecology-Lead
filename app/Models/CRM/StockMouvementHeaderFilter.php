<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMouvementHeaderFilter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getHeader(){
        return $this->belongsTo(StockMouvementHeader::class, 'header_id');
    }
}
