<?php

namespace App\Http\Controllers;

use App\Models\Spacialist;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    function adddoctor(){
        $spacialist = Spacialist::select('spacialist_id','name_th')->get();
        return view('SupportAndDoctor.adddoctor')->with('spacialist',$spacialist);
    }
   
}
