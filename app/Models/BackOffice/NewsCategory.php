<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function news(){
        return $this->hasMany(News::class, 'category_id', 'id');
    }
}
