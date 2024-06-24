<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControlType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getQuestions(){
        return $this->hasMany(QualityControlQuestion::class,'quality_control_id', 'id');
    }
}
