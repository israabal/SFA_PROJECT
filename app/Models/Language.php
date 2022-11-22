<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function getActiveStatusAttribute()
    {

       return $this->active ? 'Active' : 'InActive';
    }

    public function spareparttranslation(){
        return $this ->hasmany(SparePartTranslation::class ,'language_id','id');
    }
}
