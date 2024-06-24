<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automatise extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function getEmailTemplate(){
        return $this->belongsTo(EmailTemplate::class,'email_template', 'id');
    }
    public function getsmsTemplate(){
        return $this->belongsTo(SmsTemplate::class,'sms_template', 'id');
    }
}
