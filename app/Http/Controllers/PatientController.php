<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\CaseMD;
use App\Models\Casetype;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Specialist;
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
        $cases = CaseMD::where('idcard',$session)->orderBy('caseid','DESC')->paginate(10); //ยังไม่มีการลงบันทึกในตารางจึงต้องดึงมาจาก case ตรงๆก่อน
        $user = Patient::where('idcard',$session)->first();
        $lastbooking = CaseMD::where('idcard', $session)->orderBy('caseid', 'DESC')->first();
        if ($lastbooking) {
            $lastbooking = Booking::whereRelation('case','idcard', $session)
            ->orderBy('booking_id', 'DESC')
            ->first();
        } 
        return view('patient.dashboard')->with('cases',$cases)->with('user',$user)->with('lastbooking',$lastbooking);
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
        $specialist = Specialist::all();
        $prefix = [];
        foreach($specialist as $sub){
        array_push($prefix,substr($sub->specialist_id,0,2));
        }
        
        if(session()->has('doctor_id')){
            $doctor = Doctor::where('doctor_id',session('doctor_id'))->get();
        }
        else{
            $doctor = Doctor::all();
        }
        
        return view('SupportAndDoctor.addcase')->with('case_type',$case_type)->with('patient',$patient)->with('doctor',$doctor)->with('prefix',$prefix)
        ->with('specialist',$specialist);
    }
    function showpatient(Request $request){
            $s = $request->query('search');
            if($s != null){
                $page = Patient::where('name_th','like','%'.$s.'%')->orWhere('lastname_th','like','%'.$s.'%')->orWhere('idcard','like','%'.$s.'%')->paginate(10);
            }else{
                $page = Patient::paginate(10);
            }
            return view('SupportAndDoctor.patienlist',compact('page','s'));
    }
}
