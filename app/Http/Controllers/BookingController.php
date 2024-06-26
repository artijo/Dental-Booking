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
        $session = session('doctor_id');
        if($session){
            $cases = CaseMD::where('case_status',1)->where('doctor_id',$session)->get();
        }else{
        $cases = CaseMD::where('case_status',1)->get();
        }
        return view('SupportAndDoctor.addbooking')->with('cases',$cases);
    }
     
    function showhistory(Request $request){
        $s = $request->query('search');
        if($s){
            $booking = Booking::where('booking_id','LIKE',"%{$s}%")->orWhere('booking_title','LIKE',"%{$s}%")->orWhere('booking_detail','LIKE',"%{$s}%")->orderBy('booking_id','DESC')->paginate(10);
        }else{
        $booking = Booking::orderBy('booking_id','DESC')->paginate(10);
        }
        // $booking = Booking::with('case')->paginate(10);
        return view('SupportAndDoctor.showbooking',compact('booking','s'));
    }
}
