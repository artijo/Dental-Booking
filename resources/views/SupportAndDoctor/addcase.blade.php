@extends('layouts.global')
@section('title') เพิ่มเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เพิ่มเคสการรักษา</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}" class="current">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <form action="{{route('admin.storecase')}}" method="POST" class="add-data">
        @csrf
        <div class="add-data-item">
        <label for="idcard">ผู้เข้ารับการรักษา</label><br>
        <select class="selectidcard" name="idcard">
            @foreach($patient as $list)
            <option value="{{$list->idcard}}">{{ $list->name_th }} {{$list->lastname_th}}</option>
            @endforeach
          </select><br>
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" max="255" required><br>
        <label for="casetype_id">รูปแบบการรักษา</label><br>
        @if(!empty($case_type) && count($case_type) > 0)
            <select name="casetype_id" id="casetype">
                @foreach($case_type as $list)
                <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <input type="text" name="case_detail"><br>
        <label for="doctor_id">รับผิดชอบโดยแพทย์</label><br>
        @if(!empty($doctor) && count($doctor) > 0)
        <select class="selectdoctor" name="doctor_id">
            @foreach($doctor as $list)
            <option value="{{$list->doctor_id}}">{{ $list->name_th }} {{$list->lastname_th}}</option>
            @endforeach
          </select>
          <br>
         @else
            ไม่มีข้อมูลแพทย์ในขณะนี้<br>
        @endif
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status">
            <option value="1" selected>กำลังรักษา</option>
            <option value="2">ไม่เสร็จ (ผู้ป่วยไม่มาตามนัด)</option>
            <option value="3">ปิดเคส (เสร็จสิ้น)</option>
        </select><br>
        <input type="submit" value="เพิ่มข้อมูล" class="btn btn-plus mt-5">
    </div>
    </form>
    
</div>
</div>
@endsection