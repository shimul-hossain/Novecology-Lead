<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getStatus(){
        return $this->belongsTo(AuditStatus::class, 'audit_status', 'id');
    }
    public function getResult(){
        return $this->belongsTo(ReportResult::class, 'report_result', 'id');
    }

    public function office(){
        return $this->belongsTo(Auditor::class, 'study_office', 'id');
    }

    public function getTravaux(){
        return $this->belongsToMany(BaremeTravauxTag::class, 'audit_travauxes', 'audit_id', 'travaux_id');
    }
}
