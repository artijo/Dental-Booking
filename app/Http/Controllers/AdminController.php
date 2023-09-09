<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    function index(){
        $ss = session('supportid');
        $support = Support::where('support_id',$ss)->first();
        $name = explode(' ',$support->name);
        return view('SupportAndDoctor.index')->with('admin',$support)->with('ss',$ss)->with('name',$name[0]);
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
        $casedata = CaseMD::select('caseid')->orderBy('caseid','desc')->first();
        if ($casedata == null) {
            $caseid = 'cs0001';
        }else{
        $caseid = $casedata->caseid;
        $prefix = 'cs';
        $lastNumber = (int)substr($caseid, 2);
        $nextNumber = $lastNumber + 1;
        $caseid = $prefix . sprintf("%04d", $nextNumber);
        }

        // $caseid = $request->caseid;
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
        $doctordata = Doctor::select('doctor_id')->orderBy('doctor_id','desc')->first();
        if ($doctordata == null) {
            $doctor_id = 'dr0001';
        }else{
        $doctor_id = $doctordata->doctor_id;
        $prefix = 'dr';
        $lastNumber = (int)substr($doctor_id, 2);
        $nextNumber = $lastNumber + 1;
        $doctor_id = $prefix . sprintf("%04d", $nextNumber);
        }

        // $doctor_id = $request->doctor_id;
        $name_en = $request->name_en;
        $lastname_en = $request->lastname_en;
        $name_th = $request->name_th;
        $lastname_th = $request->lastname_th;
        $email = $request->email;
        $password = Hash::make($request->password);
        $tel = $request->tel;
        $spacialist_id = $request -> specialist_id;

        $adddoctor = new Doctor;
        $adddoctor->doctor_id = $doctor_id;
        $adddoctor->name_en = $name_en;
        $adddoctor->lastname_en = $lastname_en;
        $adddoctor->name_th = $name_th;
        $adddoctor->lastname_th = $lastname_th;
        $adddoctor->email = $email;
        $adddoctor->password = $password;
        $adddoctor->tel = $tel;
        $adddoctor->specialist_id = $spacialist_id;
        $adddoctor->save();
        return redirect('/admin');
    }

    function storebooking(Request $request){
        $bookingdata = Booking::select('booking_id')->orderBy('booking_id','desc')->first();
        if ($bookingdata == null) {
            $booking_id = 'bk0001';
        }else{
        $booking_id = $bookingdata->booking_id;
        $prefix = 'bk';
        $lastNumber = (int)substr($booking_id, 2);
        $nextNumber = $lastNumber + 1;
        $booking_id = $prefix . sprintf("%08d", $nextNumber);
        }


        // $booking_id = $request->booking_id;
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

    function addsupport(){
        return view('supports.addsupport');
    }
    function storesupport(Request $request) {
        $supportdata = Support::select('support_id')->orderBy('support_id','desc')->first();
        if ($supportdata == null) {
            $support_id = 'sp0001';
        }else{
        $supportid = $supportdata->support_id;
        $prefix = 'sp';
        $lastNumber = (int)substr($supportid, 2);
        // เพิ่มค่าของตัวเลขล่าสุด
        $nextNumber = $lastNumber + 1;
        // สร้าง support_id ใหม่
        $support_id = $prefix . sprintf("%04d", $nextNumber);
        }

        // $support_id = $request->supportid;
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $tel = $request->tel;
        (int)$level = $request->level;

        $support = new Support;
        $support->support_id = $support_id;
        $support->name = $name;
        $support->email = $email;
        $support->password = $password;
        $support->tel = $tel;
        $support->level = $level;
        $support->save();
        return redirect('/admin');
    }
}
