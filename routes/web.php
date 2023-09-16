<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () { 
    if (!session()->has('idcard')) {
        return redirect()->route('patient.login');
    }else{
        return redirect()->route('patient.index');
    }
 });

Route::get('/admin/support/login', function () {
    if(session()->has('supportid')){
        return redirect()->route('admin.index');
    }else if(session()->has('doctor_id')){
        return redirect()->route('Doctor');
    }else{
        return view('supports.login');
    }
})->name("supports.login");
Route::get('/admin/doctor/login', function () {
    if(session()->has('supportid')){
        return redirect()->route('admin.index');
    }else if(session()->has('doctor_id')){
        return redirect()->route('Doctor');
    }else{
        return view('Doctor.login');
    }
})->name("doctor.login");
Route::get('/admin/login', function () {
    if(session()->has('supportid')){
        return redirect()->route('admin.index');
    }else if(session()->has('doctor_id')){
        return redirect()->route('Doctor');
    }else{
        return view('SupportAndDoctor.login');
    }
})->name("supports.login");

Route::post('/admin/login', [SupportController::class,'checklogin'])->name('support.checklogin');
Route::post('/admin/doctor/login',[DoctorController::class,'doctorchecklogin'])->name('doctor.checklogin');
Route::middleware(['support.check'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/patientlist',[PatientController::class,'showpatient'])->name('patientlist.showpatient');
    Route::get('/admin/patient/{idcard}',[SupportController::class,'patientdetail'])->name('patientlist.patientlist');
    Route::get('/admin/showcase',[SupportController::class,'showcase'])->name('showcase.showcase');
    Route::get('/admin/case/{caseid}',[SupportController::class,'showcasedetail'])->name('showcase.showcasedetail');
    Route::get('/admin/showbooking',[BookingController::class,'showhistory'])->name('showcase.showbooking');
    Route::get('/admin/showdoctor',[SupportController::class,'showdoctor'])->name('doctor.showdoctor');
    Route::get('/admin/showdoctor/{doctor_id}',[SupportController::class,'doctordetail'])->name('doctor.detail');
    
    Route::middleware(['admin.check'])->group(function (){
        Route::get('/admin/supportlist',[AdminController::class,'showsupport'])->name('admin.showsupport');
        Route::get('/admin/addsupport',[AdminController::class,'addsupport'])->name('admin.addsupport');
        Route::post('/admin/addsupport',[AdminController::class,'storesupport'])->name('admin.storesupport');
        Route::get('/admin/support/edit/{id}',[AdminController::class,'editsupport'])->name('admin.editsupport');
        Route::put('/admin/support/update/{id}',[AdminController::class,'updatesupport'])->name('admin.updatesupport');
        Route::get('/admin/support/delete/{id}',[AdminController::class,'deletesupport'])->name('admin.deletesupport');

        Route::get('/admin/patient/delete/{idcard}',[AdminController::class,'deletepatient'])->name('admin.deletepatient');
        Route::get('/admin/doctor/delete/{id}',[AdminController::class,'deletedoctor'])->name('admin.deletedoctor');
        Route::get('/admin/case/delete/{id}',[AdminController::class,'deletecase'])->name('admin.deletecase');
        Route::get('/admin/booking/delete/{id}',[AdminController::class,'deletebooking'])->name('admin.deltebooking');
        Route::get('/admin/trash',[AdminController::class,'showtrash'])->name('admin.trash');
        Route::get('/admin/restore/patient/{id}',[AdminController::class,'restore_patient'])->name('restore.patient');
        Route::get('/admin/restore/doctor/{id}',[AdminController::class,'restore_doctor'])->name('restore.doctor');
        Route::get('/admin/restore/case/{id}',[AdminController::class,'restore_case'])->name('restore.case');
        Route::get('/admin/restore/booking/{id}',[AdminController::class,'restore_booking'])->name('restore.booking');
        Route::get('/admin/restore/support/{id}',[AdminController::class,'restore_support'])->name('restore.support');
    });
});
Route::middleware(['supportanddoctor'])->group(function (){
    Route::get('/admin/addpatient', [PatientController::class,'addpatient'])->name('patient.addpatient');
    Route::post('/admin/addpatient', [AdminController::class,'storepatient'])->name('admin.storepatient');
    Route::get('/admin/addcase',[PatientController::class,'addcase'])->name('patient.addcase');
    Route::post('/admin/addcase',[AdminController::class,'storecase'])->name('admin.storecase');
    Route::get('/admin/adddoctor',[DoctorController::class,'adddoctor'])->name('doctor.adddoctor');
    Route::post('/admin/adddoctor',[AdminController::class,'storedoctor'])->name('doctor.storedoctor');
    Route::get('/admin/addbooking',[BookingController::class,'addbooking'])->name('booking.addbooking');
    Route::post('/admin/addbooking',[AdminController::class,'storebooking'])->name('admin.storebooking');
});
Route::middleware(['doctor.check'])->group(function (){
    Route::get('/admin/doctor',[DoctorController::class,'index'])->name('Doctor');
    Route::get('/admin/doctor/patient',[DoctorController::class,'showpatient'])->name('Doctor.shpwpatient');
    Route::get('/admin/doctor/logout', [DoctorController::class,'logout'])->name('doctor.logout');
    Route::get('/admin/doctor/patient/{idcard}',[DoctorController::class,'showpatientdetail'])->name('doctor.showpatientdetail');
    Route::get('/admin/doctor/case',[DoctorController::class,'showcase'])->name('doctor.showcase');
    Route::get('/admin/doctor/case/{caseid}',[DoctorController::class,'doctorcasedetail'])->name('doctor.doctorcasedetail');
    Route::get('/admin/doctor/booking',[DoctorController::class,'showbooking'])->name('doctor.showbooking');
});

Route::middleware(['adminanddoctor'])->group(function(){
    Route::get('/admin/patient/edit/{idcard}',[AdminController::class,'editpatient'])->name('admin.editpatient');
    Route::put('/admin/doctor/patient/update/{idcard}',[AdminController::class,'updatepatient_doctor'])->name('doctor.updatepatient');
    Route::put('/admin/patient/update/{idcard}',[AdminController::class,'updatepatient_admin'])->name('admin.updatepatient');
    Route::get('/admin/doctor/edit/{id}',[AdminController::class,'editdoctor'])->name('admin.editdoctor');
    Route::put('/admin/doctor/update/{id}',[AdminController::class,'updatedoctor'])->name('admin.updatedoctor');
    Route::get('/admin/case/edit/{id}',[AdminController::class,'editcase'])->name('admin.editcase');
    Route::put('/admin/case/update/{id}',[AdminController::class,'updatecase'])->name('admin.updatecase');
    Route::get('/admin/booking/edit/{id}',[AdminController::class,'editbooking'])->name('admin.editbooking');
    Route::put('/admin/booking/update/{id}',[AdminController::class,'updatebooking'])->name('admin.updatebooking');
});

Route::get('/user/login', function () {
    return view('patient.login');
})->name("patient.login");
Route::post('/user/login',[PatientController::class,'checklogin'])->name('patient.checklogin');
Route::middleware(['patient.check'])->group(function(){
    Route::get('/user',[PatientController::class,'index'])->name('patient.index');
    Route::get('/user/case/{caseid}',[PatientController::class,'showcasedetail'])->name('patient.showcasedetail');
    Route::get('/user/logout',[PatientController::class,'logout'])->name('patient.logout');
});