<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    function index(){
        $ss = session('supportid');
        $admin = Support::where('support_id',$ss)->first();
        $name = explode(' ',$admin->name);
        return view('SupportAndDoctor.index')->with('admin',$admin)->with('ss',$ss)->with('name',$name[0]);
    }
    function logout(){
        if(session()->has('supportid')){
            session()->pull('supportid');
            return redirect('/admin/support/login');
        }
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
    function storecase(Request $request){
        $caseid = $request->caseid;
        $doctor_id = $request->doctor_id;
        $idcard = $request->idcard;
        $case_title = $request->case_title;
        $case_detail = $request->case_detail;
        $case_status = (int) $request->input('case_status');
        $casetype_id = $request->casetype_id;
        
        $case = new CaseMD;
        $case->caseid = $caseid;
        $case->doctor_id = $doctor_id;
        $case->idcard = $idcard;
        $case->case_title = $case_title;
        $case->case_detail = $case_detail;
        $case->case_status = $case_status;
        $case->casetype_id = $casetype_id;
        $case->save();
        return redirect('/admin');
    }

    function storedoctor(Request $request){
        $doctor_id = $request->doctor_id;
        $name_en = $request->name_en;
        $lastname_en = $request->lastname_en;
        $name_th = $request->name_th;
        $lastname_th = $request->lastname_th;
        $email = $request->email;
        $password = $request->password;
        $tel = $request->tel;
        $spacialist_id = $request -> input('spacialist_id');

        $adddoctor = new Doctor;
        $adddoctor->doctor_id = $doctor_id;
        $adddoctor->name_en = $name_en;
        $adddoctor->lastname_en = $lastname_en;
        $adddoctor->name_th = $name_th;
        $adddoctor->lastname_th = $lastname_th;
        $adddoctor->email = $email;
        $adddoctor->password = $password;
        $adddoctor->tel = $tel;
        $adddoctor->spacialist_id = $spacialist_id;
        $adddoctor->save();
        return redirect('/admin');
    }

    function storebooking(Request $request){
        $booking_id = $request->booking_id;
        $booking_title = $request->booking_title;
        $booking_detail = $request->booking_detail;
        $booking_date = $request->booking_date;
        $caseid = $request->caseid;

        $booking = new Booking;
        $booking->booking_id = $booking_id;
        $booking->booking_title = $booking_title;
        $booking->booking_detail = $booking_detail;
        $booking->booking_date = $booking_date;
        $booking->caseid = $caseid;
        $booking->save();
        return redirect('/admin');
    }
}
