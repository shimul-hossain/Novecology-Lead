<?php

namespace App\Models\CRM;

use App\Models\CRM\Product;
use App\Models\CRM\TravauxList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravauxTag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getTravaux(){
        return $this->belongsTo(TravauxList::class, 'travaux_id', 'id');
    }

    public function product(){
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
    }
}
