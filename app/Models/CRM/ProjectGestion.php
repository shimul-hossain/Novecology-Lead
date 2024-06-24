<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function products(){
        return $this->belongsToMany(Product::class, 'gestion_products', 'gestion_id', 'product_id');
    }

    public function getFournisseur(){
        return $this->belongsTo(Fournisseur::class, 'Fournisseur_matériel', 'id');
    }

    public function InstallateurTechnique(){
        return $this->belongsTo(User::class, 'Installateur_technique', 'id');
    }
    public function getChargeEtude(){
        return $this->belongsTo(User::class, 'Chargé_dapostropheétude', 'id');
    }
    public function getTechnicalCommercial(){
        return $this->belongsTo(User::class, 'Prévisiteur_TechnicohyphenCommercial', 'id');
    }
}
