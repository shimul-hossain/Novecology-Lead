<?php

namespace App\Models\CRM;

use App\Models\Brand;
use App\Models\CRM\TravauxTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function getMarque(){
        return $this->belongsTo(Brand::class, 'marque_id', 'id');
    }

    public function getTags(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function prestations(){
        return $this->belongsToMany(Benefit::class, 'product_benefits', 'product_id', 'benefit_id');
    }

    // public function mouvement(){
    //     return $this->hasMany(Mouvement::class, 'product_id', 'id');
    // }

    public function mouvements(){
        return $this->belongsToMany(Mouvement::class, 'stock_mouvement_products', 'product_id', 'mouvement_id');
    } 

    public function mouvementProducts(){
        return $this->hasMany(StockMouvementProduct::class, 'product_id', 'id');
    }
}
