<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SparePart extends Model
{
    use HasFactory;
    public function getActiveStatusAttribute()
    {
        
       return $this->active ? 'Active' : 'InActive';
    }

    public function spareparttranslation(){
        return $this ->hasmany(SparePartTranslation::class ,'spare_part_id','id');
    }

    public function productmodels()
    {
        return $this->hasmany(SparePart_ProductModel::class ,'spare_part_id','id');

        // return $this->belongsToMany(ProductModel::class, SparePart_ProductModel::class,'spare_part_id','product_model_id');
    }
}
