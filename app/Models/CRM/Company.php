<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $guarded = [];
    
    public $translatable = ['company_title'];

    public function get_leads()
    {
        return $this->hasMany(Lead::class);
    }
}
