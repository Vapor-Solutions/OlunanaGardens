<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodClass extends Model
{
    use HasFactory;

    public function foodClasses()
    {
        return $this->belongsToMany(FoodClass::class, 'food_class_package','food_class_id', 'package_id');
    }
}
