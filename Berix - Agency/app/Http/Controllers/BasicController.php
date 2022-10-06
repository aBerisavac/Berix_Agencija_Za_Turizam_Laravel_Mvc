<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\DestinationInformation;
use App\Models\DestinationInformationImages;
use App\Models\FooterLink;
use App\Models\NavMenuItem;

class BasicController extends Controller
{
    public $data;

    public function __construct(){
        $this->data['navMenuItems']= NavMenuItem::get();
        $this->data['footerLinks']= FooterLink::get();

        $destinations = Destination::get();
        foreach ($destinations as $destination){
           $destination->hotels=$destination->hotels()->get();

           $destination->travel_dates=$destination->travel_dates()->get();

           $destination->activities=$destination->activities()->get();
           foreach($destination->activities as $activity){
               $activity->images = $activity->images()->get();
           }

           $destination->travel_price = $destination->travel_price()->get();



            $destination->information = $destination->information()->get();
            $images = DestinationInformation::get()->where('id', $destination->information[0]->id);
            $destination->information_images = $images->first()->images()->get();

            $travelDays = [];
            $hotelPrices = [];
            foreach($destination->travel_dates as $travelDate){
                array_push($travelDays, (strtotime($travelDate->travel_ending)-strtotime($travelDate->travel_beginning))/(60 * 60 * 24));
            }
            $travelDays=min($travelDays);
            foreach ($destination->hotels as $hotel){
                array_push($hotelPrices, $hotel->price_per_night);
            }
            $hotelPrices=min($hotelPrices);
            $cheapestTripPrice=$hotelPrices*$travelDays+$destination->travel_price[0]->price;
            $destination->cheapest_trip_price=$cheapestTripPrice;
        }

        $this->data['destinations']=$destinations;
    }
}
