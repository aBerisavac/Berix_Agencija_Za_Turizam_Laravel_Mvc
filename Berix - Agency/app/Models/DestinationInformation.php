<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationInformation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'destination_informations';

    public function images(){
        return $this->hasMany(DestinationInformationImages::class, "destination_informations_id");
    }
}
