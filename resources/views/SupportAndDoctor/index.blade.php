@extends('layouts.global')
@section('title') DashBoard For Support And Admin @endsection
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
            สวัสดีคุณ {{$name}}
        </div>
        <a class="btn-logout" href="{{route('admin.logout')}}">ออกจากระบบ</a>
    </div>
    <div class="result-data flex flex-wrap gap-5 justify-center mt-5">
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้รักษาทั้งหมด (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{$patientcount}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนแพทย์ (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{$doctorcount}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนเคสการรักษาทั้งหมด (เคส)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{$casecount}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่รอเข้าพบ (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{count($cases->where('case_status',1))}}</span></div>
        </div>
        <div class="result-item">
            <div class="result-item-title">จำนวนผู้ป่วยที่เสร็จสิ้นการรักษา (คน)</div>
            <div class="result-item-data text-center"><span class="text-bold">{{count($cases->where('case_status',2))}}</span></div>
        </div>

    </div>
</div>
</div>
@endsection