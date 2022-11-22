<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartTranslation extends Model
{
    use HasFactory;
    
    public function language(){
        return $this->belongsto(Language::class ,'language_id','id');
    }

    public function sparepart(){
        return $this->belongsto(SparePart::class ,'spare_part_id','id');
    }
}
