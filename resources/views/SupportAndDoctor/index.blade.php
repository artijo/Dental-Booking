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
    
</div>
</div>
@endsection