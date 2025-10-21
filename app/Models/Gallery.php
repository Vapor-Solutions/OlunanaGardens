<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'title',
        'description',
        'photo_path',
    ];

    public function eventType() {
        return $this->belongsTo(EventType::class);
    }
}
