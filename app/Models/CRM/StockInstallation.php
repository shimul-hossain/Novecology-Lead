<?php

namespace App\Models\CRM;

use App\Models\StockActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInstallation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function installer(){
        return $this->belongsTo(User::class, 'installateur_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }

    public function products(){
        return $this->hasMany(StockInstallationProduct::class, 'installation_id', 'id');
    }

        
    public function activities(){
        return $this->hasMany(StockActivityLog::class, 'feature_id', 'id')->where('module', 'installation')->orderBy('created_at', 'desc');
    }

}
