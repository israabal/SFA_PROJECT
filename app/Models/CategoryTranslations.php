<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslations extends Model
{
    use HasFactory;
    public function language(){
        return $this->belongsto(Language::class ,'language_id','id');
    }
}
