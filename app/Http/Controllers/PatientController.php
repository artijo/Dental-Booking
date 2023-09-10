<?php

namespace App\Http\Controllers;
use App\Models\CaseMD;
use App\Models\Casetype;
use App\Models\Patient;
use Illuminate\Support\Facades\DB; //นำข้อมูลจาก Database ตั้งค่าเป็น DB ***ตั้งค่า DB_Database เป็น Database ที่เราจะนำเข้า ใน .env ในที่นี้ใช้ของ Customer มาดึงดูก่อน
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;
use Illuminate\View\View;

class PatientController extends Controller
{
    //
    function index(){
        $session = session('idcard'); 
        $booking = CaseMD::where('idcard',$session)->get(); //ยังไม่มีการลงบันทึกในตารางจึงต้องดึงมาจาก case ตรงๆก่อน
        $name = Patient::where('idcard',$session)->get();
        return view('patient.dashboard')->with('booking',$booking)->with('name',$name);
    }
    function checklogin(Request $request){
        $request->validate([
            'idcard'=>'required',
            'phone'=>'required'
        ]);
        $booking = Patient::where('idcard',$request->idcard)->first();
        if($booking){
            if($booking->tel == $request->phone){
                $request->session()->put('idcard',$booking->idcard);
                return redirect()->route('patient.index');
            }else{
                return back()->with('error','Wrong Login Details');
            }
        }else{
            return back()->with('error','ไม่มีข้อมูลคนไข้');
        }
    }
    function logout(){
        if(session()->has('idcard')){
            session()->pull('idcard');
            return redirect()->route('patient.login');
        }
    }
    function addpatient(){
        return view('SupportAndDoctor.addpatient');
    }
    function addcase(){
        $case_type = Casetype::all();
        return view('SupportAndDoctor.addcase')->with('case_type',$case_type);
    }
    function showpatient(){
            $page = Patient::paginate(8);
            return view('SupportAndDoctor.patienlist',compact('page'));
    }
}
