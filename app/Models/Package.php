<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


    public function foodClasses()
    {
        return $this->belongsToMany(FoodClass::class, 'food_class_package', 'package_id', 'food_class_id');
    }
}
