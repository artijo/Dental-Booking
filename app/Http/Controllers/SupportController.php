<?php

namespace App\Http\Controllers;

use App\Models\CaseMD;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    //
    function index(){
        return view('supports.index');
    }
    function login(){
        return view('supports.login');
    }
    function checklogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $support = Support::where('email',$request->email)->first();
        if($support){
            if(Hash::check($request->password, $support->password)){
                $request->session()->put('supportid',$support->support_id);
                return redirect()->route('admin.index');
            }else{
                return back()->with('error','Wrong Login Details');
            }
        }else{
            return back()->with('error','You don\'t have Authorize');
        }
    }

    function showcase(){
        $cases = CaseMD::paginate(10);
        return view('Supports.showcase')->with('cases',$cases);
    }

    function showcasedetail($caseid){
        $case = CaseMD::where('caseid', $caseid)->first();
        return view("Supports.casedetail",compact('case'));
    }

    function showdoctor(){
        $casecount = Doctor::select(DB::raw('COUNT(case_m_d_s.caseid) as casetotal,CONCAT(doctors.name_th," ",doctors.lastname_th) as fullname,doctors.tel as tel,doctors.doctor_id as doctorid'))
        ->leftjoin('case_m_d_s', 'doctors.doctor_id','=','case_m_d_s.doctor_id')->groupBy('doctors.doctor_id','doctors.tel','doctors.name_th','doctors.lastname_th')->paginate(6);
        return view('SupportAndDoctor.showdoctor')->with('count',$casecount);
    }

    function doctordetail($doctor_id){
        $doctor = Doctor::where('doctor_id',$doctor_id)->first();
        $support = Support::where('support_id',session()->get('supportid'))->first();
        return view('SupportAndDoctor.doctordetail',compact('doctor','support'));
    }
    function patientdetail($idcard){
        $patient = Patient::where('idcard',$idcard)->first();
        $support = Support::where('support_id',session()->get('supportid'))->first();
        return view('Supports.patientdetail',compact('patient','support'));
    }
}