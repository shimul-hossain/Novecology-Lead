<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewLead extends Model
{
    use HasFactory;
    protected $table = 'leads';

    protected $guarded = [];
}
