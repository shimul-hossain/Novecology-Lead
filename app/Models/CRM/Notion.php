<?php

namespace App\Models\CRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getCategory(){
        return $this->belongsTo(NotionCategory::class, 'category_id', 'id');
    }

    public function assignee(){
        return $this->belongsToMany(User::class, 'notion_assigns', 'notion_id', 'user_id');
    }
}
