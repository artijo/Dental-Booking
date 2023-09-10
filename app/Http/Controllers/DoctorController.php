<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CaseMD;

class DoctorController extends Controller
{
    function adddoctor(){
        $spacialist = Specialist::select('specialist_id','name_th')->get();
        return view('SupportAndDoctor.adddoctor')->with('spacialist',$spacialist);
    }
    function index(){
        $dt = session('doctor_id');
        $doctor = Doctor::where('doctor_id',$dt)->first();
        return view('Doctor.index')->with('doctor',$doctor);
    }

    function logout(){
        if(session()->has('doctor_id')){
            session()->pull('doctor_id');
            return redirect()->route('doctor.login');
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

    function doctorviewcase(){
        $casedoctor = doctor::where('doctor_id',session('doctor_id'))->first();
        $viewpatient = CaseMD::where('doctor_id', session(('doctor_id')))->paginate(6);
        return view("Doctor.doctorcase",compact('casedoctor','viewpatient'));
    }

    function doctorcasedetail(){
        $casedoctor = doctor::where('doctor_id',session('doctor_id'))->first();
        $viewpatient = CaseMD::where('doctor_id', session(('doctor_id')))->paginate(6);
        return view("Doctor.doctorcasedetail",compact('casedoctor','viewpatient'));
    }
}
