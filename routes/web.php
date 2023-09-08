<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
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
    return view('patient.login');
})->name("patient.login");
Route::get('/table',[BookingController::class,'index']);

Route::get('/admin/support/login', function () {
    return view('supports.login');
})->name("supports.login");

Route::get('/admin/login', function () {
    return view('SupportAndDoctor.login');
})->name("supports.login");

Route::post('/admin/support/login', [SupportController::class,'checklogin']);
Route::middleware(['admin.check'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin');
    Route::get('/admin/addpatient', [PatientController::class,'addpatient'])->name('patient.addpatient');
    Route::post('/admin/addpatient', [AdminController::class,'storepatient'])->name('admin.storepatient');
    Route::get('/admin/addcase',[PatientController::class,'addcase'])->name('patient.addcase');
    Route::post('/admin/addcase',[AdminController::class,'storecase'])->name('admin.storecase');
    Route::get('/admin/adddoctor',[DoctorController::class,'adddoctor'])->name('doctor.adddoctor');
    Route::post('/admin/adddoctor',[AdminController::class,'storedoctor'])->name('doctor.storedoctor');

});


Route::post('/booking',[PatientController::class,'checklogin']);



