<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function getActiveStatusAttribute()
    {

       return $this->active ? 'Active' : 'InActive';
    }
    public function subcategories(){
        return $this->hasmany(SubCategory::class,'category_id','id');
    }

    public function user(){
        return $this->belongsto(Admin::class ,'admin_id','id');
    }

}
