<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurSolution extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function get_reasons()
    {
        return $this->hasMany('\App\Models\SolutionResons', 'our_solutions_id', 'id');
    }
}

