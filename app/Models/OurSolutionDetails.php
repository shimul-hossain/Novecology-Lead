<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurSolutionDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function solution()
    {
        return $this->belongsTo(OurSolution::class);
    }
}
