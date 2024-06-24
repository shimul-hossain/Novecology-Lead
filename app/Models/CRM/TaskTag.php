<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTag(){
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
