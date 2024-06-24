<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getOffers(){
        return $this->hasMany(Offer::class, 'category_id', 'id');
    }
}
