<?php

namespace App\Models\CRM;

use App\Models\StockActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function fournisseur(){
        return $this->belongsTo(FournisseurMateriel::class, 'fournisseur_id', 'id');
    }

    public function statut(){
        return $this->belongsTo(StatutCommande::class, 'statut_id', 'id');
    }

    public function typeDeLivraison(){
        return $this->belongsTo(TypeDeLivraison::class, 'type_de_livraison_id', 'id');
    }
    public function enlevementPar(){
        return $this->belongsTo(PersonnelAutoriseReception::class, 'enlevement_par_id', 'id');
    }
    public function recuPar(){
        return $this->belongsTo(PersonnelAutoriseReception::class, 'recu_par_id', 'id');
    }
    public function products(){
        return $this->hasMany(CommandeProduct::class, 'commande_id', 'id');
    }
    
    public function activities(){
        return $this->hasMany(StockActivityLog::class, 'feature_id', 'id')->where('module', 'commande')->orderBy('created_at', 'desc');
    }
}
