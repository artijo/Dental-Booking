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
        <h3>ยินดีต้อนรับสู่ระบบจัดการโรงพยาบาล</h3>
    </div>
    <div class="profile">
        <div class="name">
            สวัสดีคุณ {{$doctor->name_th}} {{$doctor->lastname_th}}
        </div>
        <a class="btn-logout" href="{{route('doctor.logout')}}">ออกจากระบบ</a>
    </div>
    <div class="result-data flex flex-wrap gap-5 justify-center mt-5">
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้รักษากับท่านทั้งหมด (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{$patientcount}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนเคสการรักษาทั้งหมด (เคส)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{count($doctor->cases)}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่รอเข้าพบ (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{count($doctor->cases->where('case_status',1))}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่เสร็จสิ้นการรักษา (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{count($doctor->cases->where('case_status',3))}}</span></div>
        </div>

    </div>
    
</div>
</div>
@endsection