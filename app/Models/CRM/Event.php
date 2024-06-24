<?php

namespace App\Models\CRM;

use App\Models\User;
use App\Models\CRM\Client;
use App\Models\CRM\Project;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded =[];
    use HasTranslations;
    public $translatable = ['title', 'description'];

    public function getCategory(){
        return $this->belongsTo(EventCategory::class, 'category_id', 'id');
    }
 
    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function getProject(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getAssignee(){
        return $this->belongsToMany(User::class, 'event_assigns', 'event_id', 'user_id');
    }
    
}
