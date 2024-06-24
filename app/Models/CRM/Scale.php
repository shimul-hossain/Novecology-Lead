<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barmeTravaux(){
        return $this->belongsTo(TravauxList::class, 'travaux', 'id');
    }

    public function baremeTag(){
        return $this->belongsTo(TravauxTag::class, 'tag', 'id');
    }

    public function product(){
        return $this->belongsToMany(Product::class, 'scale_products', 'scale_id', 'product_id');
    }

}
