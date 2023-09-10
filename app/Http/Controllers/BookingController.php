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
        return view('SupportAndDoctor.addbooking');
    }
     
    function showhistory(){
        $booking = Booking::paginate(8);
        return view('SupportAndDoctor.showcase',compact('booking'));
    }
}
