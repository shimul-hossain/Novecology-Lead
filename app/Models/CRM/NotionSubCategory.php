<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotionSubCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getCategory(){
        return $this->belongsTo(NotionCategory::class, 'category_id', 'id');
    }
}
