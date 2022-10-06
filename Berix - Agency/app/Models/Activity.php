<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = "activities";

    public function images(){
        return $this->hasMany(ActivityImage::class,  "activity_id", "id");
    }
}
