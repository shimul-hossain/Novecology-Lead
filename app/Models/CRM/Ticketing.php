<?php

namespace App\Models\CRM;

use App\Models\User;
use App\Models\CRM\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticketing extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function assignee(){
        return $this->belongsToMany(User::class, 'ticket_assigns', 'ticket_id', 'user_id');
    }

    public function problem(){
        return $this->belongsTo(TicketProblemStatus::class, 'problem_id', 'id');
    }

    public function openby(){
        return $this->belongsTo(User::class, 'open_by', 'id');
    }

    public function closeby(){
        return $this->belongsTo(User::class, 'close_by', 'id');
    }

    public function message(){
        return $this->hasMany(TicketingMessage::class, 'ticket_id', 'id')->orderBy('id', 'desc');
    }

    public function project(){
        return $this->belongsTo(NewProject::class, 'project_id', 'id');
    }
}
