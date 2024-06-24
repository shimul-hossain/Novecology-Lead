<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getCategory(){
        return $this->belongsTo(OfferCategory::class, 'category_id', 'id');
    }

    public function bannerService(){
        return $this->hasMany(OfferBannerService::class, 'offer_id', 'id');
    }

    public function thirdBlockInfo(){
        return $this->hasMany(OfferThirdBlockInfo::class, 'offer_id', 'id');
    }
    public function fifthBlockInfo(){
        return $this->hasMany(OfferFifthBlockInfo::class, 'offer_id', 'id');
    }
    public function sixthBlockInfo(){
        return $this->hasMany(OfferSixthBlockInfo::class, 'offer_id', 'id');
    }
}
