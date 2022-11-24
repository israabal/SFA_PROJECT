<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairProblem extends Model
{
    use HasFactory;
    public function repair()
    {
        return $this->hasOne(Repair::class);
    }


    public function problem()
    {
        return $this->hasOne(Problem::class,'id','problem_id');

    }
    
}
