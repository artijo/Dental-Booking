<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;
use App\Models\Patient;

class AdminController extends Controller
{
    //
    function index(){
        $ss = session('supportid');
        $admin = Support::find("$ss");
        return view('SupportAndDoctor.index',['admin'=>$admin]);
    }
    function addpatient(){
        return view('SupportAndDoctor.addpatient');
    }
    function storepatient(Request $request){
        $idcard = $request->idcard;
        $name_en = $request->name_en;
        $lastname_en = $request->lastname_en;
        $name_th = $request->name_th;
        $lastname_th = $request->lastname_th;
        $tel = $request->tel;
        $email = $request->email;
        $gender = $request->gender;
        $birthday = $request->birthday;
        $intolerance = $request->intolerance;

        $patient = new Patient;
        $patient->idcard = $idcard;
        $patient->name_en = $name_en;
        $patient->lastname_en = $lastname_en;
        $patient->name_th = $name_th;
        $patient->lastname_th = $lastname_th;
        $patient->tel = $tel;
        $patient->email = $email;
        $patient->gender = $gender;
        $patient->intolerance = $intolerance;
        $patient->birthday = $birthday;
        $patient->save();
        return redirect('/admin');

    }
}
