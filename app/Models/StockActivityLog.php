<?php

namespace App\Models;

use App\Models\CRM\Entrepot;
use App\Models\CRM\FournisseurMateriel;
use App\Models\CRM\NatureMouvement;
use App\Models\CRM\NewProject;
use App\Models\CRM\PersonnelAutoriseReception;
use App\Models\CRM\Product;
use App\Models\CRM\StatutCommande;
use App\Models\CRM\TypeDeLivraison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockActivityLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

        
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'value', 'id');
    }
    public function project(){
        return $this->belongsTo(NewProject::class, 'value', 'id');
    }
    public function mouvement(){
        return $this->belongsTo(NatureMouvement::class, 'value', 'id');
    }
    public function entrepot(){
        return $this->belongsTo(Entrepot::class, 'value', 'id');
    }
    public function installer(){
        return $this->belongsTo(User::class, 'value', 'id');
    }
    public function personnelAutorise(){
        return $this->belongsTo(PersonnelAutoriseReception::class, 'value', 'id');
    }
    public function commandeStatut(){
        return $this->belongsTo(StatutCommande::class, 'value', 'id');
    }

    public function fournisseur(){
        return $this->belongsTo(FournisseurMateriel::class, 'value', 'id');
    }

    public function typeDeLivraison(){
        return $this->belongsTo(TypeDeLivraison::class, 'value', 'id');
    } 
}
