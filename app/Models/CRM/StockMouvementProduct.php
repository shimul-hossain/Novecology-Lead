<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMouvementProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function allMouvementProduct(){
        return $this->hasMany(StockMouvementProduct::class, 'product_id', 'product_id');
    }

    // public function 
}
