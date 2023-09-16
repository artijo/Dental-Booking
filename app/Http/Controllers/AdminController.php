<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialist;
use App\Models\Casetype;
use Illuminate\Support\Facades\Hash;
use Phattarachai\ThaiIdCardValidation\ThaiIdCardRule;

class AdminController extends Controller
{
    //
    function index(){
        $ss = session('supportid');
        $support = Support::where('support_id',$ss)->first();
        $supportcount = Support::count();
        $doctorcount = Doctor::count();
        $patientcount = Patient::count();
        $casecount = CaseMD::count();
        $bookingcount = Booking::count();
        $cases = CaseMD::all();
        $name = explode(' ',$support->name);
        return view('SupportAndDoctor.index',compact('supportcount','doctorcount','patientcount','casecount','bookingcount','cases'))->with('admin',$support)->with('ss',$ss)->with('name',$name[0]);
    }
    function logout(){
        if(session()->has('supportid')){
            session()->pull('supportid');
            session()->pull('level');
            return redirect()->route('supports.login');
        }
    }
    //ส่วนของผู้เข้ารักษา////////////////////////////////////////////////////////////////////////////////////////
    function storepatient(Request $request){
        $request->validate([
            'idcard' => ['required', 'unique:patients', new ThaiIdCardRule],
        ]);

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
        if(session()->has('doctor_id')){
            return redirect('/admin/doctor/patient')->with('success','เพิ่มข้อมูลคนไข้สำเร็จ'); 
        }else{
            return redirect('/admin/patientlist/')->with('success','เพิ่มข้อมูลคนไข้สำเร็จ');
        }

    }

    function editpatient ($idcard) {
        $patient = Patient::where('idcard',$idcard)->first();
        return view('SupportAndDoctor.editpatient')->with('patient',$patient);
    }


    function updatepatient_doctor (Request $request, $idcard) {
        $caseid = CaseMD::Where('idcard',$idcard)->first();
        Patient::Where('idcard',$idcard)
        ->update([
        'name_en' => $request->name_en,
        'lastname_en' => $request->lastname_en,
        'name_th' => $request->name_th,
        'lastname_th' => $request->lastname_th,
        'tel' => $request->tel,
        'email' => $request->email,
        'gender' => $request->gender,
        'intolerance' => $request->intolerance,
        'birthday' => $request->birthday
        ]);
        return redirect('/admin/doctor/patient/'.$caseid->idcard);
    }


    function updatepatient_admin (Request $request, $idcard) {
        $caseid = CaseMD::Where('idcard',$idcard)->first();
        Patient::Where('idcard',$idcard)
        ->update([
        'name_en' => $request->name_en,
        'lastname_en' => $request->lastname_en,
        'name_th' => $request->name_th,
        'lastname_th' => $request->lastname_th,
        'tel' => $request->tel,
        'email' => $request->email,
        'gender' => $request->gender,
        'intolerance' => $request->intolerance,
        'birthday' => $request->birthday
        ]);
        return redirect('/admin/patient/'.$caseid->idcard);
    }


    function deletepatient($idcard){
        $patient = Patient::find($idcard);
        foreach($patient->cases as $item){
            $item->bookings()->delete();
        }
        $patient->cases()->delete();
        Patient::where('idcard',$idcard)->delete();
        return redirect('/admin/patientlist');
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    function storecase(Request $request){
        $casedata = CaseMD::select('caseid')->orderBy('caseid','desc')->first();
        if ($casedata == null) {
            $caseid = 'cs000001';
        }else{
        $caseid = $casedata->caseid;
        $prefix = 'cs';
        $lastNumber = (int)substr($caseid, 2);
        $nextNumber = $lastNumber + 1;
        $caseid = $prefix . sprintf("%06d", $nextNumber);
        }

        // $caseid = $request->caseid;
        $doctor_id = $request->doctor_id;
        $idcard = $request->idcard;
        $case_title = $request->case_title;
        $case_detail = $request->case_detail;
        $case_status = (int) $request->input('case_status');
        $casetype_id = $request-> casetype_id;
        
        $case = new CaseMD;
        $case->caseid = $caseid;
        $case->doctor_id = $doctor_id;
        $case->idcard = $idcard;
        $case->case_title = $case_title;
        $case->case_detail = $case_detail;
        $case->case_status = $case_status;
        $case->casetype_id = $casetype_id;
        $case->save();
        if(session()->has('doctor_id')){
            return redirect('/admin/doctor/case')->with('success','เพิ่มข้อมูลเคสการรักษาสำเร็จ');
        }else{
            return redirect('/admin/showcase')->with('success','เพิ่มข้อมูลเคสการรักษาสำเร็จ');
        }
    }
    function editcase($id){
        $case = CaseMD::where('caseid',$id)->first();
        $case_type = Casetype::all();
        return view('SupportAndDoctor.editcase')->with('case',$case)->with('case_type',$case_type);
    }
    function updatecase(Request $request, $id){
        CaseMD::Where('caseid',$id)
        ->update([
        'case_title' => $request->case_title,
        'case_detail' => $request->case_detail,
        'case_status' => $request->case_status,
        'casetype_id' => $request->casetype_id
        ]);
        return redirect('/admin');
    }
    function deletecase($id){
        CaseMD::where('caseid',$id)->delete();
        Booking::where('caseid',$id)->delete();
        return redirect('/admin/showcase');
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
        //checkmathpassword
        if ($request->password != $request->password_cf) {
            return back()->with('error','รหัสผ่านไม่ตรงกัน');
        }

        // $doctor_id = $request->doctor_id;
        $name_en = $request->name_en;
        $lastname_en = $request->lastname_en;
        $name_th = $request->name_th;
        $lastname_th = $request->lastname_th;
        $email = $request->email;
        $password = Hash::make($request->password);
        $tel = $request->tel;
        foreach($request->specialist_id as $special){
        $spacialist_id [] = $special;
        }

        $adddoctor = new Doctor;
        $adddoctor->doctor_id = $doctor_id;
        $adddoctor->name_en = $name_en;
        $adddoctor->lastname_en = $lastname_en;
        $adddoctor->name_th = $name_th;
        $adddoctor->lastname_th = $lastname_th;
        $adddoctor->email = $email;
        $adddoctor->password = $password;
        $adddoctor->tel = $tel;
        foreach($spacialist_id as $addspecial){
        $adddoctor->specialist_id = $addspecial;
        }
        $adddoctor->save();
        $doctor = Doctor::where('doctor_id',$doctor_id)->first();
        $specialist = $spacialist_id;
            $doctor->specialists()->attach($specialist);
        return redirect('/admin/showdoctor')->with('success','เพิ่มข้อมูลแพทย์สำเร็จ');
    }
    function editdoctor($id){
        $spacialist = Specialist::select('specialist_id','name_th')->get();
        $doctor = Doctor::where('doctor_id',$id)->first();
        return view('SupportAndDoctor.editdoctor')->with('spacialist',$spacialist)->with('doctor',$doctor);
    }
    function updatedoctor(Request $request, $id){
        $data = Doctor::where('doctor_id',$id)->first();
                //caheckmathpassword
        if ($request->password != $request->password_cf) {
            return back()->with('error','รหัสผ่านไม่ตรงกัน');
        }
        if ($request->password == null) {
            $request->password = $data->password;
        }else{
            $request->password = Hash::make($request->password);
        }

        foreach($request->specialist_id as $morespecial){
            $addmoresp[] = $morespecial;
        }
        
        foreach($addmoresp as $more){
        Doctor::Where('doctor_id',$id)
        ->update([
        'name_en' => $request->name_en,
        'lastname_en' => $request->lastname_en,
        'name_th' => $request->name_th,
        'lastname_th' => $request->lastname_th,
        'email' => $request->email,
        'password' => $request->password,
        'tel' => $request->tel,
        'specialist_id' => $more
        ]);
    }
        $specialist = $addmoresp;
            $data->specialists()->attach($specialist);
        return redirect('/admin');
    }
    function deletedoctor($id){
        $doctor = Doctor::find($id);
        foreach($doctor->cases as $item){
            $item->bookings()->delete();
        }
        $doctor->cases()->delete();
        Doctor::where('doctor_id',$id)->delete();
        return redirect('/admin/showdoctor');
    }
    function storebooking(Request $request){
        $bookingdata = Booking::select('booking_id')->orderBy('booking_id','desc')->first();
        if ($bookingdata == null) {
            $booking_id = 'bk000001';
        }else{
        $booking_id = $bookingdata->booking_id;
        $prefix = 'bk';
        $lastNumber = (int)substr($booking_id, 2);
        $nextNumber = $lastNumber + 1;
        $booking_id = $prefix . sprintf("%06d", $nextNumber);
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
    function editbooking($id){
        $booking = Booking::where('booking_id',$id)->first();
        return view('SupportAndDoctor.editbooking')->with('booking',$booking);
    }
    function updatebooking(Request $request, $id){
        Booking::Where('booking_id',$id)
        ->update([
        'booking_title' => $request->booking_title,
        'booking_detail' => $request->booking_detail,
        'booking_date' => $request->booking_date
        ]);
        return redirect('/admin');
    }
    function deletebooking($booking_id){
        Booking::where('booking_id',$booking_id)->delete();
        return redirect('/admin/showbooking');
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
        //checkmathpassword
        if(request('password') != request('password_cf')){
            return back()->with('error','รหัสผ่านไม่ตรงกัน');
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
    function editsupport($id){
        $support = Support::where('support_id',$id)->first();
        return view('supports.editsupport')->with('support',$support);
    }
    function updatesupport(Request $request, $id){
        $data = Support::where('support_id',$id)->first();
        //caheckmathpassword
        if ($request->password != $request->password_cf) {
            return back()->with('error','รหัสผ่านไม่ตรงกัน');
        }
        if ($request->password == null) {
            $request->password = $data->password;

        }else{
            $request->password = Hash::make($request->password);
        }
        
        Support::Where('support_id',$id)
        ->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'tel' => $request->tel,
        'level' => $request->level
        ]);
        return redirect('/admin');
    }
    function deletesupport($id){
        Support::where('support_id',$id)->delete();
        return redirect('/admin');
    }

    function showsupport(){
        $s = request()->query('search');
        if($s != null){
            $supports = Support::where('name','like','%'.$s.'%')->orWhere('support_id','like','%'.$s.'%')->paginate(10);
        }else{
        $supports = Support::paginate(10);
        }
        return view('supports.showsupport')->with('supports',$supports)->with('s',$s);
    }

    function showtrash(){
        return view('SupportAndDoctor.showtrash');
    }
}
