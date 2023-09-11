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
     
    function showhistory(){
        $booking = Booking::with('case')->paginate(8);
        return view('SupportAndDoctor.showcase',compact('booking'));
    }
}
