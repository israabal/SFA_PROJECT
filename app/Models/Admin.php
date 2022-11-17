<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    public function getActiveStatusAttribute()
    {
        
       return $this->active ? 'Active' : 'InActive';
    }
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
