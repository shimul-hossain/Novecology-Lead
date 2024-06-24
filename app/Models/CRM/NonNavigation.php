<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NonNavigation extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = [];
    
    public $translatable = ['name'];
}
