@extends('layouts.global')
@section('title') DashBoard For Support And Admin @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>Dashboard</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}" class="current">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="{{route('admin.showsupport')}}">รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
</nav>
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
    
</div>
</div>
@endsection