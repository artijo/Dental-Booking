<?php

namespace App\Http\Controllers;
use App\Models\CaseMD;
use App\Models\Patient;
use Illuminate\Support\Facades\DB; //นำข้อมูลจาก Database ตั้งค่าเป็น DB ***ตั้งค่า DB_Database เป็น Database ที่เราจะนำเข้า ใน .env ในที่นี้ใช้ของ Customer มาดึงดูก่อน
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;

class PatientController extends Controller
{
    //
    function checklogin(Request $request){
        $request->validate([
            'idcard'=>'required',
            'phone'=>'required'
        ]);
        $booking = Patient::where('idcard',$request->idcard)->first();
        if($booking){
            if($booking->tel == $request->phone){
                $request->session()->put('idcard',$booking->idcard);
                return redirect('/table');
            }else{
                return back()->with('error','Wrong Login Details');
            }
        }else{
            return back()->with('error','ไม่มีข้อมูลคนไข้');
        }
    }
    function addpatient(){
        return view('SupportAndDoctor.addpatient');
    }
    function addcase(){
        return view('SupportAndDoctor.addcase');
    }
}
