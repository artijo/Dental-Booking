@extends('layouts.global')
@section('title') ข้อมูลเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลเคสการรักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{ url('/admin/booking/update/'.$booking->booking_id) }}" method="POST" class="add-data">
        @csrf
        @method('PUT')
        <div class="add-data-item">
        <label for="caseid">รหัสเคส</label><br>
        <input type="text" name="caseid" value="{{$booking->case->patient->name_th}} {{$booking->case->patient->lastname_th}} ({{$booking->case->case_title}}:{{$booking->caseid}})" disabled><br>

        <label for="booking_title">หัวข้อการนัด</label><br>
        <input type="text" name="booking_title" value="{{$booking->booking_title}}" max="255" required><br>

        <label for="booking_detail">รายละเอียดการนัด</label><br>
        <input type="text" name="booking_detail" value="{{$booking->booking_detail}}"><br>

        <label for="booking_date">วันและเวลาที่นัด</label><br>
        <input type="datetime-local" name="booking_date" value="{{$booking->booking_date}}" required><br>

        <input type="submit" name="booking_submit" value="บันทึก" class="btn btn-plus">
    </div>
    </form>
</div>
</div>
@endsection