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
    return view('supports.login');
})->name("supports.login");

Route::get('/admin/doctor/login', function () {
    return view('Doctor.login');
})->name("doctor.login");

Route::get('/admin/login', function () {
    return view('SupportAndDoctor.login');
})->name("supports.login");

Route::post('/admin/login', [SupportController::class,'checklogin'])->name('support.checklogin');
Route::post('/admin/doctor/login',[DoctorController::class,'doctorchecklogin'])->name('doctor.checklogin');
Route::middleware(['support.check'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/patientlist',[PatientController::class,'showpatient'])->name('patientlist.showpatient');
    Route::get('/admin/showcase',[BookingController::class,'showhistory'])->name('showcase.showhistory');
    
    Route::middleware(['admin.check'])->group(function (){
        Route::get('/admin/addsupport',[AdminController::class,'addsupport'])->name('admin.addsupport');
        Route::post('/admin/addsupport',[AdminController::class,'storesupport'])->name('admin.storesupport');

        Route::get('/admin/support/edit/{id}',[AdminController::class,'editsupport'])->name('admin.editsupport');
        Route::put('/admin/support/update/{id}',[AdminController::class,'updatesupport'])->name('admin.updatesupport');
        Route::get('/admin/support/delete/{id}',[AdminController::class,'deletesupport'])->name('admin.deletesupport');
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
    Route::get('/admin/doctor/logout', [DoctorController::class,'logout'])->name('doctor.logout');
    Route::get('/admin/doctor/patient/{idcard}',[DoctorController::class,'showpatientdetail'])->name('doctor.showpatientdetail');
    Route::get('/admin/doctor/case/{caseid}',[DoctorController::class,'doctorcasedetail'])->name('doctor.doctorcasedetail');
});

Route::middleware(['adminanddoctor'])->group(function(){
    Route::get('/admin/patient/edit/{idcard}',[AdminController::class,'editpatient'])->name('admin.editpatient');
    Route::put('/admin/patient/update/{idcard}',[AdminController::class,'updatepatient'])->name('admin.updatepatient');
    Route::get('/admin/patient/delete/{idcard}',[AdminController::class,'deletepatient'])->name('admin.deletepatient');
    Route::get('/admin/doctor/edit/{id}',[AdminController::class,'editdoctor'])->name('admin.editdoctor');
    Route::put('/admin/doctor/update/{id}',[AdminController::class,'updatedoctor'])->name('admin.updatedoctor');
    Route::get('/admin/doctor/delete/{id}',[AdminController::class,'deletedoctor'])->name('admin.deletedoctor');
    Route::get('/admin/case/edit/{id}',[AdminController::class,'editcase'])->name('admin.editcase');
    Route::put('/admin/case/update/{id}',[AdminController::class,'updatecase'])->name('admin.updatecase');
    Route::get('/admin/case/delete/{id}',[AdminController::class,'deletecase'])->name('admin.deletecase');
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

