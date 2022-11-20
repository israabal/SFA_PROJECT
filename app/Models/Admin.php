<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable,HasRoles;  

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