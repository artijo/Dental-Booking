@extends('layouts.global')
@section('title') ข้อมูลแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลแพทย์</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" class="current">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="flex justify-end gap-5 mb-5">
        <a href=""><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
        <a href=""><button class="btn btn-delete">ลบข้อมูล</button></a>
    </div>
    <div class="content">
        <div class="head">
            <h3>รหัสทันตแพทย์(ID):{{$doctor->doctor_id}}</h3>
        </div>
    <div class="body">
    ชื่อ-นามสกุล: ทพ.{{$doctor->name_th}} {{$doctor->lastname_th}}<br>
    Fullname: DR.{{$doctor->name_en}} {{$doctor->lastname_en}}<br>
    <h3>ข้อมูลการติดต่อ(Contact)</h3>
    อีเมล: {{$doctor->email}}<br>
    เบอร์โทรศัพท์: {{$doctor->tel}}<br>
    <h3>ความเชี่ยวชาญเฉพาะทาง(Specialist)</h3>
    <ul>
        @foreach($doctor->specialists as $special)
        <li>{{$special->name_th}}</li>
        @endforeach
    </ul>
</div>
</div>
    </div>
    </div>
@endsection