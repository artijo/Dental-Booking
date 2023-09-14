<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use App\Models\Patient;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    function addbooking(){
        $cases = CaseMD::where('case_status',1)->get();
        return view('SupportAndDoctor.addbooking')->with('cases',$cases);
    }
     
    function showhistory(Request $request){
        $s = $request->query('search');
        if($s){
            $booking = Booking::where('booking_id','LIKE',"%{$s}%")->orWhere('booking_title','LIKE',"%{$s}%")->orWhere('booking_detail','LIKE',"%{$s}%")->paginate(10);
        }else{
        $booking = Booking::paginate(10);
        }
        // $booking = Booking::with('case')->paginate(10);
        return view('SupportAndDoctor.showbooking',compact('booking','s'));
    }
}
