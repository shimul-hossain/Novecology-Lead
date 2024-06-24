<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getBaremes(){
        return $this->belongsTo(Scale::class, 'operation', 'id');
    }
    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getPrestation(){
        return $this->hasMany(AdditionalProduct::class, 'linked_operation', 'id')->orderBy('order', 'asc');
    }
}
