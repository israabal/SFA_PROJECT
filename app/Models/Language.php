<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public function categorytranslations(){
        return $this->hasmany(CategoryTranslations::class,'language_id','id');
    }
}
