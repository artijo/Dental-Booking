<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Doctor;

class AdminController extends Controller
{
    //
    function index(){
        $ss = session('supportid');
        $admin = Support::find("$ss");
        return view('SupportAndDoctor.index',['admin'=>$admin]);
    }
}
