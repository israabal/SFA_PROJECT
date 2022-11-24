<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    public function product_models()
    {
        return $this->hasOne(SModel::class);
    }

   public function user()
   {
       return $this->hasOne(User::class,'id','user_id');
   }

   public function repair()
   {
       return $this->hasOne(repair::class);
   }
}
