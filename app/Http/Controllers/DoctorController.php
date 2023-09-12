<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CaseMD;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    function adddoctor(){
        $spacialist = Specialist::select('specialist_id','name_th')->get();
        return view('SupportAndDoctor.adddoctor')->with('spacialist',$spacialist);
    }
    function index(){
        $dt = session('doctor_id');
        $cases = CaseMD::select(DB::raw('count(caseid) as casetotal, CONCAT(patients.name_th, " ", patients.lastname_th) as fullname, patients.tel as tel, patients.idcard as idcard'))
    ->join('patients', 'case_m_d_s.idcard', '=', 'patients.idcard')
    ->groupBy('patients.name_th','patients.lastname_th','patients.tel', 'patients.idcard')
    ->paginate(6);
        $doctor = Doctor::where('doctor_id',$dt)->first();
        // $patient = CaseMD::where('doctor_id', session(('doctor_id')))->paginate(6);
        return view('Doctor.index')->with('doctor',$doctor)->with('cases',$cases);
    }

    function logout(){
        if(session()->has('doctor_id')){
            session()->pull('doctor_id');
            return redirect()->route('supports.login');
        }
    }
    function doctorchecklogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $doctor = Doctor::where('email',$request->email)->first();
        if($doctor){
            if(Hash::check($request->password, $doctor->password)){
                $request->session()->put('doctor_id',$doctor->doctor_id);
                return redirect()->route('Doctor');
            }else{
                return back()->with('error','Wrong Login Details');
            }
        }else{
            return back()->with('error','You don\'t have Authorize');
        }
        
    }

    function showpatientdetail($idcard){
        $patient = Patient::where('idcard',$idcard)->first();
        $cases = CaseMD::where('idcard',$idcard)->get();
        return view('Doctor.patientdetail')->with('patient',$patient)->with('cases',$cases);
    }

    function doctorcasedetail($caseid){
        $case = CaseMD::where('caseid', $caseid)->first();
        return view("Doctor.doctorcasedetail",compact('case'));
    }
}
