<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getItems(){
        return $this->hasMany(PrestationGroupItem::class, 'prestation_group_id', 'id');
    }
}
