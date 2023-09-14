@extends('layouts.global')
@section('title') เพิ่มข้อมูลการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เพิ่มข้อมูลการนัด</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}"  class="current">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <form action="{{route('admin.storebooking')}}" method="POST" class="add-data">
        @csrf
        <div class="add-data-item">
        <label for="caseid">รหัสเคส</label><br>
        @if(!empty($cases) && count($cases) > 0)
        <select class="selectcase" name="caseid">
            @foreach($cases as $list)
            <option value="{{$list->caseid}}">{{ $list->caseid }}</option>
            @endforeach
          </select><br>
        @else
                ไม่มีข้อมูลเคสในขณะนี้<br>
        @endif
        <label for="booking_title">หัวข้อการนัด</label><br>
        <input type="text" name="booking_title" max="255" required><br>

        <label for="booking_detail">รายละเอียดการนัด</label><br>
        <input type="text" name="booking_detail"><br>

        <label for="booking_date">วันและเวลาที่นัด</label><br>
        <input type="datetime-local" name="booking_date" required><br>

        <input type="submit" name="booking_submit" value="บันทึก" class="btn btn-plus mt-5">
    </div>
    </form>
</div>
</div>
@endsection