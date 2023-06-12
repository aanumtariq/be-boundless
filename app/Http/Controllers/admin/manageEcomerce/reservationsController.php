<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Http\Controllers\Controller;
use App\Models\reservations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reservationsController extends Controller
{
    //
    public function getReservations(Request $req)
    {
        if ($req->has('getEditRes')) {
            $reservationData = reservations::where('Id', $req->getEditRes)->first();
            return response()->json(['reservationData' => $reservationData]);
        } else {
            $reservationsData = reservations::orderBy('Id', 'DESC')->get();
            return view('admin.manageEcom.reservations', ['reservations' => $reservationsData]);
        }
    }

    public function getViewReservations(Request $req)
    {
        $reservationData = reservations::with('reservationDetails')->where('Id', $req->getResId)->first();
        return response()->json(['reservationData' => $reservationData]);
    }

    public function editReservation(Request $req)
    {
        try {
            reservations::where('Id', $req->upResId)->update(['status' => $req->upReservationStatus]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function delReservation(Request $req)
    {
        try {
            DB::table('reservations')->where('Id', $req->deleteReservation)->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
