<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadTax extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getLead(){
        return $this->belongsTo(LeadClientProject::class, 'lead_id', 'id');
    }

    public function callbackUser(){
        return $this->belongsTo(User::class, 'callback_user_id', 'id');
    }

    public function getDeclarant(){
        return $this->hasMany(LeadTaxDeclarant::class, 'tax_id', 'id');
    }
}
