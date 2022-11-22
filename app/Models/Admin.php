<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    public function categories(){
        return $this ->hasmany(Category::class ,'admin_id','id');
    }
    public function subcategories(){
        return $this ->hasmany(SubCategory::class ,'admin_id','id');
    }

    public function models(){
        return $this ->hasmany(ProductModel::class ,'admin_id','id');
    }
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
