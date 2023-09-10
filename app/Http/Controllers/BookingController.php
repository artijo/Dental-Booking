<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use App\Models\Patient;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    function index(){
        $session = session('idcard'); 
        $booking = CaseMD::where('idcard',$session)->get(); //ยังไม่มีการลงบันทึกในตารางจึงต้องดึงมาจาก case ตรงๆก่อน
        $name = Patient::where('idcard',$session)->get();
        return view('patient.booking')->with('booking',$booking)->with('name',$name);
    }

    function addbooking(){
        return view('SupportAndDoctor.addbooking');
    }
     
    function showhistory(){
        $booking = Booking::paginate(8);
        return view('SupportAndDoctor.showcase',compact('booking'));
    }
}
