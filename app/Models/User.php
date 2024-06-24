<?php

namespace App\Models;

use App\Models\CRM\ActionPermission;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\CommentCategory;
use App\Models\CRM\Lead;
use App\Models\CRM\Role;
use App\Models\CRM\Event;
use App\Models\CRM\Regie;
use App\Models\CRM\Ticketing;
use App\Models\CRM\LeadAssign;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\Mouvement;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewEvent;
use App\Models\CRM\NewProject;
use App\Models\CRM\NewTask;
use App\Models\CRM\Notion;
use App\Models\CRM\NotionAssign;
use App\Models\CRM\PersonalNote;
use App\Models\CRM\PlanningFilter;
use App\Models\CRM\PlanningInterventionFilter;
use App\Models\CRM\PlanningTravauxFilter;
use App\Models\CRM\PlanningView;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\StockCommandeHeaderFilter;
use App\Models\CRM\StockInstallation;
use App\Models\CRM\StockMouvementHeaderFilter;
use Carbon\Carbon;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'color', 'background_color', 'email_professional', 'phone_professional', 'prenom_professional', 'bar_th_164', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
     
    /**
     * Set the post title.
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getRoleName(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function getLeadAssign(){
        return $this->hasMany(LeadAssign::class, 'user_id', 'id');
    }
    public function getRegie(){
        return $this->belongsTo(Regie::class, 'regie_id', 'id');
    }
    public function getRegieTelecommercial(){
        return $this->hasOne(Regie::class, 'team_leader_id', 'id');
    }

    public function allRegie(){
        return $this->hasMany(Regie::class, 'team_leader_id', 'id');
    }

    public function leads(){
        return $this->belongsToMany(Lead::class, 'lead_assigns', 'user_id', 'lead_id');
    }

    public function getLeads(){
        return $this->hasMany(LeadClientProject::class, 'lead_telecommercial', 'id')->where('lead_deleted_status', 0);
    }
    public function ticket(){
        return $this->belongsToMany(Ticketing::class, 'ticket_assigns', 'user_id', 'ticket_id');
    }

    public function getEvent(){
        return $this->belongsToMany(Event::class, 'event_assigns', 'user_id', 'event_id')->orderBy('start_date');
    }

    public function notion(){
        return $this->belongsToMany(Notion::class, 'notion_assigns', 'user_id', 'notion_id');
    }

    public function commentCategory(){
        return $this->belongsToMany(CommentCategory::class, 'comment_category_assigns', 'user_id', 'comment_category_id');
    }

    public function getProjects(){
        return $this->hasMany(NewProject::class, 'project_gestionnaire', 'id')->where('deleted_status', 0);
    }

    public function getTelecommiercialProjects(){
        return $this->hasMany(NewProject::class, 'project_telecommercial', 'id')->where('deleted_status', 0);
    }
    public function getClients(){
        return $this->hasMany(NewClient::class, 'lead_telecommercial', 'id')->where('deleted_status', 0);
    }
    public function getTeamLeader(){
        return $this->belongsTo(User::class, 'team_leader',  'id');
    }
    public function getTeamUsers(){
        return $this->hasMany(User::class, 'team_leader',  'id')->where('deleted_status', 'no')->where('status', 'active');;
    }

    public function planningFilter(){
        return $this->hasMany(PlanningFilter::class, 'login_user_id', 'id');
    }
    public function planningFilterUsers(){
        return $this->belongsToMany(User::class, 'planning_filters', 'login_user_id', 'user_id');
    }

    public function getIntervention(){
        $schedules30 = \Carbon\CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
        foreach($schedules30 as $d){
            $min_30_interval[] = Carbon::parse($d)->format("G").'h'.Carbon::parse($d)->format("i");
        } 
        return $this->hasMany(ProjectIntervention::class, 'user_id', 'id')->with('getProject')->orderBy('Date_intervention', 'asc')->orderByRaw("FIELD(Horaire_intervention, '".implode("', '", $min_30_interval)."') ASC");
    }

    public function getFilteredIntervention(){
        return $this->hasMany(PlanningInterventionFilter::class, 'user_id', 'id');
    }
    public function getFilteredTravaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'planning_travaux_filters', 'user_id', 'travaux_id');
    }
    public function getFilteredTravaux2(){
        return $this->hasMany(PlanningTravauxFilter::class, 'user_id', 'id');
    }

    public function getPlanningView(){
        return $this->hasOne(PlanningView::class, 'user_id', 'id');
    }

    public function createdEvent(){
        return $this->hasMany(NewEvent::class, 'created_by', 'id');
    }
     
    public function leadRappler(){
        return $this->hasMany(LeadClientProject::class, 'callback_user_id', 'id')->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now())->where('lead_deleted_status', 0);
    }
    public function clientRappler(){
        return $this->hasMany(NewClient::class, 'callback_user_id', 'id')->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now());
    }
    public function projectRappler(){
        return $this->hasMany(NewProject::class, 'callback_user_id', 'id')->whereNotNull('callback_time')->where('callback_time', '>', Carbon::now());
    }
    public function checkAction(){
        return $this->hasMany(ActionPermission::class, 'user_id', 'id');
    }

    public function getNotes(){
        return $this->hasMany(PersonalNote::class, 'user_id', 'id');
    }

    public function getTasks(){
        return $this->hasMany(NewTask::class, 'user_id', 'id');
    }

    public function stockMouvementHeaderFilter(){
        return $this->hasMany(StockMouvementHeaderFilter::class, 'user_id', 'id')->orderBy('header_id');
    }
    public function stockCommandeHeaderFilter(){
        return $this->hasMany(StockCommandeHeaderFilter::class, 'user_id', 'id')->orderBy('header_id');
    }

    public function stockInstallations(){
        return $this->hasMany(StockInstallation::class, 'installateur_id', 'id')->orderBy('date', 'desc');
    }

    public function mouvements(){
        return $this->hasMany(Mouvement::class, 'user_id', 'id');
    }
}
