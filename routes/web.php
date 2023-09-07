<?php

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

Route::get('/admin/support/login', function () {
    return view('supports.login');
})->name("supports.login");

Route::post('/admin/support/login', [SupportController::class,'checklogin']);
Route::get('/admin', [AdminController::class,'index'])->name('admin');

Route::get('/booking',[PatientController::class,'index']);
