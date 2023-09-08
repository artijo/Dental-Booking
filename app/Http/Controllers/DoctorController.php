<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    function adddoctor(){
        return view('SupportAndDoctor.adddoctor');
    }
   
}
