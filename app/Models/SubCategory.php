<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public function getActiveStatusAttribute()
    {
        
       return $this->active ? 'Active' : 'InActive';
    }
    public function category(){
        return $this->belongsto(Category::class ,'category_id','id');
    }
}
