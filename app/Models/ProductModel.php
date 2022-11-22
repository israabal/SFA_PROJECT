<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }


    public function getActiveStatusAttribute()
    {
        
       return $this->active ? 'Active' : 'InActive';
    }
    public function admin(){
        return $this->belongsto(Admin::class ,'admin_id','id');
    }

    public function category(){
        return $this->belongsto(Category::class ,'category_id','id');
    }

    public function subcategory(){
        return $this->belongsto(SubCategory::class ,'sub_category_id','id');
    }


    public function spareparts()
    {
        return $this->belongsToMany(SparePart::class, SparePart_ProductModel::class,'product_model_id','spare_part_id');
    }
    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->images()->first()->url);
    }
    public function getMainImageAttribute()
    {
        return $this->images()->first()->url;
    }
}
