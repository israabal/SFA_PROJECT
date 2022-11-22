<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintinanceApp extends Model
{
    use HasFactory;
public function users()
{
    return $this->hasMany(user::class ,'user_id');
}
public function getActiveStatusAttribute()
{
   return $this->active ? 'Active' : 'InActive';
}
}
