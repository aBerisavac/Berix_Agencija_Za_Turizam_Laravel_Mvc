<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'destination_hotels', 'destination_id', 'hotel_id');
    }

    public function travel_dates()
    {
        return $this->belongsToMany(TravelDate::class, 'destination_travel_dates', 'destination_id', 'travel_date_id');
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'destination_activities', 'destination_id', 'activity_id');
    }

    public function travel_price()
    {
        return $this->hasOne(TravelPrice::class);
    }

    public function information()
    {
        return $this->belongsTo(DestinationInformation::class, "destination_information_id");
    }

}
