@extends('layouts.global')
@section('title') DashBoard For Doctor @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>Dashboard</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('Doctor')}}" class="current">หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
    </ul>
</nav>
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
    
</div>
</div>
@endsection