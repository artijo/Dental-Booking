@extends('layouts.global')
@section('title') แก้ไขเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>แก้ไขเคสการรักษา</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    @if(session('supportid'))
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}" class="current">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="{{route('admin.showsupport')}}">รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
    @elseif(session('doctor_id'))
    <ul>
    <li><a href="{{route('Doctor')}}">หน้าหลัก</a></li>
    <li><a href="{{route('Doctor.shpwpatient')}}">รายชื่อผู้รักษาของคุณ</a></li>
    <li><a href="{{route('doctor.showcase')}}" class="current">ประวัติเคสการรักษาของคุณ</a></li>
    <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
</ul>
    @endif
</nav>
<div class="content-dashboard">
    <form action="{{url('/admin/case/update/'.$case->caseid)}}" method="POST" class="add-data">
        @csrf
        @method('PUT')
        <div class="add-data-item">
        <label for="idcard">รหัสบัตรประชาชน(ผู้เข้ารับการรักษา)</label><br>
        <input type="number" name="idcard" value="{{$case->idcard}}" disabled><br>
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" value="{{$case->case_title}}" max="255" required><br>
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
        <input type="text" name="case_detail" value="{{$case->case_detail}}"><br>
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        <input type="text" name="doctor_id" value="{{$case->doctor_id}}" disabled><br>
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status" required>
            <option value="1">กำลังรักษา</option>
            <option value="2">ยกเลิกเคส</option>
            <option value="3" selected>เสร็จสิ้น</option>
        </select><br>
        <input type="submit" value="บันทึกเคสการรักษา" class="btn btn-plus mt-5">
    </div>
    </form>
</div>
</div>
@endsection