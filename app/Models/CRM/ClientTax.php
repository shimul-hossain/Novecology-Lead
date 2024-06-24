<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTax extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }
    public function getClient(){
        return $this->belongsTo(NewClient::class, 'client_id', 'id');
    }
    
    public function getDeclarant(){
        return $this->hasMany(ClientTaxDeclarant::class, 'tax_id', 'id');
    }
}
