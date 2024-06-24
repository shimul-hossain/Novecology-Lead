<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanqueDepot extends Model
{
    use HasFactory;
    protected $guarded = ['id'];    

    public function banque(){
        return $this->belongsTo(Banque::class, 'banque_id', 'id');
    }
}
