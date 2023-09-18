<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CaseMD;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialist;
use App\Models\Casetype;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Phattarachai\ThaiIdCardValidation\ThaiIdCardRule;
use Illuminate\Support\Facades\DB;

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
            'tel' => ['required', 'unique:patients']
        ],
        ['idcard.required' => 'กรุณากรอกเลขบัตรประชาชน',
        'idcard.unique' => 'เลขบัตรประชาชนนี้มีในระบบแล้ว',
        'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
        ]
    );

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
        $request->validate([
            'tel' => ['required', 'unique:patients,tel,'.$idcard.',idcard']
        ],
        ['tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
        ]
    );
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
        return redirect('/admin/doctor/patient/'.$idcard)->with('success','แก้ไขข้อมูลคนไข้สำเร็จ');
    }


    function updatepatient_admin (Request $request, $idcard) {
        $request->validate([
            'tel' => ['required', 'unique:patients,tel,'.$idcard.',idcard']
        ],
        ['tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว',
        ]
    );
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
        return redirect('/admin/patient/'.$idcard)->with('success','แก้ไขข้อมูลคนไข้สำเร็จ');
    }


    function deletepatient($idcard){
        $patient = Patient::find($idcard);
        foreach($patient->cases as $item){
            $item->bookings()->delete();
        }
        $patient->cases()->delete();
        Patient::where('idcard',$idcard)->delete();
        return redirect('/admin/patientlist')->with('success','ลบข้อมูลคนไข้สำเร็จ');
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    function storecase(Request $request){
        $casedata = CaseMD::select('caseid')->orderBy('caseid','desc')->withTrashed()->first();
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

    function casefilter(Request $request){
        $case_prefix = $request->input('id');

        $data = Doctor::select('doctor_id','name_th','lastname_th')->whereHas('specialists',function($query) use ($case_prefix){
            $query->where('doctor_specialist.specialist_id','LIKE',$case_prefix.'%');})->get();
        return response()->json($data);
    }

    function editcase($id){
        $case = CaseMD::select('doctor_id','idcard')->where('caseid',$id)->first();
        $case_type = Casetype::all();
        $doctor = Doctor::all();
        return view('SupportAndDoctor.editcase')->with('case',$case)->with('case_type',$case_type)->with('doctor',$doctor);
    }
    function updatecase(Request $request, $id){
        if($request->doctor_id == null){
            return back()->with('error','โปรดเลือกหมดที่รับผิดชอบ');
        }else{
            CaseMD::Where('caseid',$id)
            ->update([
            'case_title' => $request->case_title,
            'case_detail' => $request->case_detail,
            'case_status' => $request->case_status,
            'casetype_id' => $request->casetype_id,
            'doctor_id' => $request->doctor_id
            ]);
        }
        if(session()->has('doctor_id')){
            return redirect('/admin/doctor/case/'.$id)->with('success','แก้ไขข้อมูลเคสการรักษาสำเร็จ');
        }else{
            return redirect('/admin/case/'.$id)->with('success','แก้ไขข้อมูลเคสการรักษาสำเร็จ');
        }
    }
    function deletecase($id){
        CaseMD::where('caseid',$id)->delete();
        Booking::where('caseid',$id)->delete();
        return redirect('/admin/showcase')->with('success','ลบข้อมูลเคสการรักษาสำเร็จ');
    }

    function storedoctor(Request $request){
        $request->validate([
            'email' => 'required|email|unique:doctors',
            'password' => 'required|min:8',
            'password_cf' => 'required',
            'tel' => ['required', 'unique:doctors']
        ],
        ['email.required' => 'กรุณากรอกอีเมล',
        'email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
        'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
        'password.required' => 'กรุณากรอกรหัสผ่าน',
        'password_cf.required' => 'กรุณากรอกรหัสผ่านอีกครั้ง',
        'password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
        'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
        ]
        );
        $doctordata = Doctor::select('doctor_id')->orderBy('doctor_id','desc')->first();
        $exist = Doctor::withTrashed()->orderBy('doctor_id','desc')->first();

        if ($doctordata == null) {
            $doctor_id = 'dr0001';
        }elseif($exist){
            $doctor_id = $exist->doctor_id;
            $prefix = 'dr';
            $last= (int)substr($doctor_id,2);
            $next= $last + 1;
            $doctor_id = $prefix.sprintf("%04d",$next);
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
        if ($request->specialist_id === null){
            return back()->with('error_sp','โปรดกรอกความสามารถของคุณ');
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
        $request->validate([
            'email' => 'required|email|unique:doctors,email,'.$id.',doctor_id',
            'tel' => ['required', 'unique:doctors,tel,'.$id.',doctor_id']
        ],
        ['email.required' => 'กรุณากรอกอีเมล',
        'email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
        'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
        'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
    ]);
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
        $data->specialists()->syncWithoutDetaching($addmoresp);

        return redirect('/admin/showdoctor/'.$id)->with('success','แก้ไขข้อมูลแพทย์สำเร็จ');
    }
    function deletedoctor($id){
        $doctor = Doctor::find($id);

        foreach($doctor->cases as $item){
            $item->bookings()->delete();
        }
        $doctor->cases()->delete();
        
        $doctor->delete();
        return redirect('/admin/showdoctor')->with('success','ลบข้อมูลแพทย์สำเร็จ');
    }
    function storebooking(Request $request){
        $bookingdata = Booking::select('booking_id')->orderBy('booking_id','desc')->withTrashed()->first();
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
        if(session()->has('doctor_id')){
            return redirect('/admin/doctor/booking')->with('success','เพิ่มข้อมูลการนัดหมายสำเร็จ');
        }else{
            return redirect('/admin/showbooking')->with('success','เพิ่มข้อมูลการนัดหมายสำเร็จ');
        }
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
        if(session()->has('doctor_id')){
            return redirect('/admin/doctor/booking/')->with('success','แก้ไขข้อมูลการนัดหมายสำเร็จ');
        }else{
            return redirect('/admin/showbooking/')->with('success','แก้ไขข้อมูลการนัดหมายสำเร็จ');
        }
    }
    function deletebooking($booking_id){
        Booking::where('booking_id',$booking_id)->delete();
        return redirect('/admin/showbooking')->with('success','ลบข้อมูลการนัดหมายสำเร็จ');
    }

    function addsupport(){
        return view('supports.addsupport');
    }
    function storesupport(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:supports',
            'password' => 'required|min:8',
            'password_cf' => 'required',
            'tel' => ['required', 'unique:supports']
        ],
        ['email.required' => 'กรุณากรอกอีเมล',
        'email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
        'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
        'password.required' => 'กรุณากรอกรหัสผ่าน',
        'password_cf.required' => 'กรุณากรอกรหัสผ่านอีกครั้ง',
        'password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
        'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
        ]
        );
        $supportdata = Support::select('support_id')->orderBy('support_id','desc')->withTrashed()->first();
        $exist = Support::withTrashed()->orderBy('support_id','desc')->first();
        if ($supportdata == null) {
            $support_id = 'sp0001';
        }elseif($exist){
            $support_id = $exist->support_id;
            $prefix = 'sp';
            $last= (int)substr($support_id,2);
            $next= $last + 1;
            $support_id = $prefix.sprintf("%04d",$next);
        }
        else{
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
        return redirect('/admin/supportlist')->with('success','เพิ่มข้อมูลผู้ดูแลระบบสำเร็จ');
    }
    function editsupport($id){
        $support = Support::where('support_id',$id)->first();
        return view('supports.editsupport')->with('support',$support);
    }
    function updatesupport(Request $request, $id){
        $request->validate([
            'email' => 'required|email|unique:supports,email,'.$id.',support_id',
            'tel' => ['required', 'unique:supports,tel,'.$id.',support_id']
        ],
        ['email.required' => 'กรุณากรอกอีเมล',
        'email.email' => 'กรุณากรอกอีเมลให้ถูกต้อง',
        'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
        'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        'tel.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว'
        ]
        );
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
        return redirect('/admin/supportlist')->with('success','แก้ไขข้อมูลผู้ดูแลระบบสำเร็จ');
    }
    function deletesupport($id){
        Support::where('support_id',$id)->delete();
        return redirect('/admin/supportlist')->with('success','ลบข้อมูลผู้ดูแลระบบสำเร็จ');
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
        $doctor = Doctor::onlyTrashed()->get();
        $patient = Patient::onlyTrashed()->get();
        $case = CaseMD::onlyTrashed()->get();
        $booking = Booking::onlyTrashed()->get();
        $support = Support::onlyTrashed()->get();
        return view('SupportAndDoctor.showtrash',compact('doctor','patient','case','booking','support'));
    }

    function restore_patient($id){
        Patient::where('idcard',$id)->restore();
        return redirect('/admin/trash');
    }

    function restore_doctor($id){
        Doctor::where('doctor_id',$id)->restore();
        return redirect('/admin/trash');
    }

    function restore_case($id){
        CaseMD::where('caseid',$id)->restore();
        return redirect('/admin/trash');
    }

    function restore_booking($booking_id,$case_id){
        $booking = Booking::onlyTrashed()->where('booking_id', $booking_id)->first();
        $booking->restore();

        $case = CaseMD::onlyTrashed()->where('caseid', $case_id)->first();
        if($case && $case->trashed()){
        $case->restore();
        }


        return redirect('/admin/trash');
    }

    function restore_support($id){
        Support::where('support_id',$id)->restore();
        
        return redirect('/admin/trash');
    }

    function harddelete_patient($id){
        Patient::where('idcard',$id)->forceDelete();
        return redirect('/admin/trash');
    }

    function harddelete_doctor($id){
        $doctor = Doctor::onlyTrashed()->where('doctor_id',$id)->first();
        
        $doctor->specialists()->detach();
        if($doctor->trashed()){
            $doctor->forceDelete();
        }

        return redirect('/admin/trash');
    }

    function harddelete_case($id){
        Booking::onlyTrashed()->where('caseid',$id)->forceDelete();
        CaseMD::onlyTrashed()->where('caseid',$id)->forceDelete();
        
        return redirect('/admin/trash');
    }

    function harddelete_booking($id){
        Booking::onlyTrashed()->where('booking_id',$id)->forceDelete();
        
        return redirect('/admin/trash');
    }

    function harddelete_support($id){
        Support::onlyTrashed()->where('support_id',$id)->forceDelete();

        return redirect('/admin/trash');
    }
}
