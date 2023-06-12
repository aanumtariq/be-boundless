<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservations;

class IndexController extends Controller
{
    //
    public function panel()
    {
        // $tSales = reservations::where('status','!=','Payment Pending')->andWhere('status','!=','Canceled')->sum('total');
        $tSales = reservations::where(function($query) {
            return $query->where('status','!=','Payment Pending')->where('status','!=','Canceled');
         })->sum('total');
        $tOrdes = reservations::select('bookingId')->count();
        $tPendingPay = reservations::where('status','Payment Pending')->sum('total');
     
        return view('admin.index',['tSales'=>$tSales,'tOrdes'=>$tOrdes,'tPendingPay'=>$tPendingPay]);
    }
    // Income chart
    public function incomeChart(Request $request){
        $year=\Carbon\Carbon::now()->year;
      
        $items=reservations::whereYear('created_at',$year)->where(function($query) {
            return $query->where('status','!=','Payment Pending')->where('status','!=','Canceled');
        })->get()->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });            
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                 $amount=$item->total;
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}
