<?php

namespace App\Models\CRM;

use App\Models\StockActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function project(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }
    public function natureMouvement(){
        return $this->belongsTo(NatureMouvement::class, 'mouvement_id', 'id');
    }
    public function entrepot(){
        return $this->belongsTo(Entrepot::class, 'entrepot_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reception(){
        return $this->belongsTo(PersonnelAutoriseReception::class, 'personnel_autorise_id', 'id');
    }

    public function products(){
        return $this->hasMany(StockMouvementProduct::class, 'mouvement_id', 'id');
    }
    
    public function activities(){
        return $this->hasMany(StockActivityLog::class, 'feature_id', 'id')->where('module', 'mouvement')->orderBy('created_at', 'desc');
    }
}
