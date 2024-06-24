<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotionCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subCategories(){
        return $this->hasMany(NotionSubCategory::class, 'category_id', 'id')->orderBy('order', 'asc');
    }
}
