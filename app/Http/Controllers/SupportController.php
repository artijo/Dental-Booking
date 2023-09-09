<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;

class SupportController extends Controller
{
    //
    function index(){
        return view('supports.index');
    }
    function login(){
        return view('supports.login');
    }
    function checklogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $support = Support::where('email',$request->email)->first();
        if($support){
            if($support->password == $request->password){
                $request->session()->put('supportid',$support->support_id);
                return redirect('/admin');
            }else{
                return back()->with('error','Wrong Login Details');
            }
        }
    }
}