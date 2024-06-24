<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleQuality extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function getQuestions(){
        return $this->hasMany(QualityControlQuestion::class,'quality_control_id', 'id');
    }
    public function getType(){
        return $this->belongsTo(QualityControlType::class,'qc_type_id', 'id');
    }

}
