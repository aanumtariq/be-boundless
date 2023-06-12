<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\packages;
use App\Models\reservations;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    //           
    public function reservation($slug)
    {
        $packageData = packages::where('pSlug', $slug)->select('Id','pBookingId','pName','noOfDays')->first();
        return view('Ecomm.reservation')->with(['packageData' => $packageData]);
    }

    public function reservation_submit(Request $req){
        // dd($req->all());
        if (Auth::check()) {
            $userId = strval(auth()->user()->id);
        } else {
            $userId = 'guest';
        }
        $packageData = packages::where('Id', $req->packageId)->select('pPrice')->first();


        try {
            
            $reserObj = new reservations();
            $reserObj->bookingId = $req->bookingId;
            $reserObj->pId = $req->packageId;
            $reserObj->userId = $userId;
            $reserObj->fullName = $req->fName.' '.$req->lName;
            $reserObj->email = $req->email;
            $reserObj->phone = $req->phone;
            $reserObj->pickupAddress = $req->pickupAddress;
            $reserObj->destinationAddress = $req->destinationAddress;
            $reserObj->noOfPassengers = $req->noOfPassengers;
            $reserObj->noOfDays = $req->noOfDays;
            $reserObj->additionalMsg = $req->additionalMsg;
            $reserObj->total = $packageData->pPrice;
            $reserObj->paymentMethod = "On Site";
            $reserObj->departureDate = $req->departureDate.' '.$req->departureTime;
            $reserObj->returnDate = $req->returnDate.' '.$req->returnTime;
            $reserObj->status = 'Payment Pending';            
            $reserObj->save();

            return back()->with('notify_success', 'Reservation Completed');
        } catch (\Throwable $th) {
            return $th;
        }        
    }

}
