<?php

namespace App\Http\Controllers;
use App\Models\CaseMD;
use App\Models\Casetype;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB; //นำข้อมูลจาก Database ตั้งค่าเป็น DB ***ตั้งค่า DB_Database เป็น Database ที่เราจะนำเข้า ใน .env ในที่นี้ใช้ของ Customer มาดึงดูก่อน
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;
use Illuminate\View\View;
use Phattarachai\ThaiIdCardValidation\ThaiIdCardRule;

class PatientController extends Controller
{
    //
    function index(){
        $session = session('idcard');
        $cases = CaseMD::where('idcard',$session)->with('bookings')->get(); //ยังไม่มีการลงบันทึกในตารางจึงต้องดึงมาจาก case ตรงๆก่อน
        $user = Patient::where('idcard',$session)->first();
        return view('patient.dashboard')->with('cases',$cases)->with('user',$user);
    }

    function showcasedetail($caseid){
        $user = Patient::where('idcard',session('idcard'))->first();
        $case = CaseMD::where('caseid',$caseid)->with('bookings')->first();
        return view('patient.casedetail')->with('case',$case)->with('user',$user);
    }
    function checklogin(Request $request){
        $request->validate([
            'idcard' => ['required', new ThaiIdCardRule],
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
        $patient = Patient::all();
        $doctor = Doctor::all();
        return view('SupportAndDoctor.addcase')->with('case_type',$case_type)->with('patient',$patient)->with('doctor',$doctor);
    }
    function showpatient(){
            $page = Patient::paginate(2);
            return view('SupportAndDoctor.patienlist',compact('page'));
    }
}
