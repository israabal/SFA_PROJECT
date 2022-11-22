<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersEquipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_models_id',
        'user_id',
        'active',
    ];
}
