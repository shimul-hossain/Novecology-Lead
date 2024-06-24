<?php

namespace App\Models\CRM;

use App\Models\PrescriptionChantierNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaremeTravauxTag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getControlPhoto(){
        return $this->hasMany(ProjectControlPhoto::class, 'tag_id', 'id');
    }

    public function getProducts(){
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id')->where('projet_status', 'yes');
    }

    public function travauxQuestion(){
        return $this->hasMany(TravauxQuestion::class, 'travaux', 'id')->orderBy('order');
    }

    public function getPrescriptionChantierNote(){
        return $this->hasOne(PrescriptionChantierNote::class, 'travaux_id', 'id');
    }
}
