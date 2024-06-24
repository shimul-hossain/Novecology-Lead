<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceGalleryCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getImages(){
        return $this->hasMany(ReferenceGallery::class, 'category_id', 'id');
    }
}


