<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Spacialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    function adddoctor(){
        $spacialist = Spacialist::select('spacialist_id','name_th')->get();
        return view('SupportAndDoctor.adddoctor')->with('spacialist',$spacialist);
    }
    function index(){
        $dt = session('doctor_id');
        $doctor = Doctor::where('doctor_id',$dt);
        return view('Doctor.index')->with('doctor',$doctor);
    }
    function doctorlogin(Request $request){
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
}
