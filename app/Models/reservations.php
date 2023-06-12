<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    use HasFactory;
    public $fillable = [
        'bookingId','pId','userId','fullName','email','phone','pickupAddress','destinationAddress','noOfPassengers','noOfDays','additionalMsg','total','paymentMethod','departureDate','arrivalDate','status','created_at','updated_at'
    ];
    public function reservationDetails()
    {
        return $this->belongsTo('App\Models\packages', 'pId', 'Id');
    }
}
