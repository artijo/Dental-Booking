<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; //นำข้อมูลจาก Database ตั้งค่าเป็น DB ***ตั้งค่า DB_Database เป็น Database ที่เราจะนำเข้า ใน .env ในที่นี้ใช้ของ Customer มาดึงดูก่อน
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    function index(){
        return view('patient.booking');
    }
    function addpatient(){
        return view('SupportAndDoctor.addpatient');
    }
}
