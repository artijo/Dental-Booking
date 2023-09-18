@extends('layouts.global')
@section('title') แก้ไขเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>แก้ไขเคสการรักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{url('/admin/case/update/'.$case->caseid)}}" method="POST" class="add-data">
        @csrf
        @method('PUT')
        <div class="add-data-item">
        <label for="idcard">รหัสบัตรประชาชน(ผู้เข้ารับการรักษา)</label><br>
        @if($case->patient)
        <input type="number" name="idcard" value="{{$case->idcard}}" disabled><br>
        @else
        <input type="number" name="idcard" value="ไม่พบข้อมูลผู้เข้ารักษา" placeholder='ไม่พบข้อมูลผู้เข้ารักษา' disabled><br>
        @endif
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" value="{{$case->case_title}}" max="255" required><br>
        <label for="casetype_id">รูปแบบการรักษา</label><br>
        @if(!empty($case_type) && count($case_type) > 0)
            <select name="casetype_id" id="casetype" class="casetype">
                @foreach($case_type as $list)
                <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <textarea name="case_detail" rows="10" cols="50">{{$case->case_detail}}</textarea><br>
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        @if($case)
        @if(session()->has('error'))
            {{ session()->get('error') }}
        @endif
            <select name="doctor_id" single class="doctor">
                @if($case->doctor)
                @foreach($doctor as $doctors)
                <option value="{{$doctors->doctor_id}}" selected>{{$doctors->name_th}} {{$doctors->lastname_th}}</option>
                @endforeach
                @else
                <option value="0" disabled='true' selected>เลือกหมอ</option>
                @endif
            </select><br>
        @else
        <input type="text" name="doctor_id" value="ไม่มีข้อมูลทันตแพทย์" disabled><br>
        @endif
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