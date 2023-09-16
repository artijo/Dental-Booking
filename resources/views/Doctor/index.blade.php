@extends('layouts.global')
@section('title') DashBoard For Doctor @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>Dashboard</h1></div>
    <div class="space"></div>
    @include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="sayhello">
        <h3>ยินดีต้อนรับสู่ระบบจัดการโรงพยาบาลอาร์ตติโจ</h3>
    </div>
    <div class="profile">
        <div class="name">
            สวัสดีคุณ {{$doctor->name_th}} {{$doctor->lastname_th}}
        </div>
        <a class="btn-logout" href="{{route('doctor.logout')}}">ออกจากระบบ</a>
    </div>
    <div class="result-data">
        <div class="result-item">
            <div class="result-item-title">จำนวนเคสการรักษาทั้งหมด</div>
            <div class="result-item-data">{{count($doctor->cases)}}</div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่รอเข้าพบ</div>
            <div class="result-item-data">{{count($doctor->cases->where('case_status',1))}}</div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่เสร็จสิ้นการรักษา</div>
            <div class="result-item-data">{{count($doctor->cases->where('case_status',3))}}</div>
        </div>

    </div>
    
</div>
</div>
@endsection