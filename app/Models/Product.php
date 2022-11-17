<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }


    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->images()->first()->url);
    }
    public function getMainImageAttribute()
    {
        return $this->images()->first()->name;
    }
}
