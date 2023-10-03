@extends('layouts.global')
@section('title') เพิ่มข้อมูลการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เพิ่มข้อมูลการนัด</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{route('admin.storebooking')}}" method="POST" class="add-data">
        @csrf
        <div class="add-data-item">
        <label for="caseid">รหัสเคส</label><br>
        @if(session()->has('error'))
        <div class="alert alert-danger">
            <p style="color:red;">{{ session()->get('error') }}</p>
        @endif
        @if(!empty($cases) && count($cases) > 0)
        <select class="selectcase" name="caseid">
            @foreach($cases as $list)
            <option value="{{$list->caseid}}">{{ $list->patient->name_th }} {{$list->patient->lastname_th}} ({{$list->case_title}}:{{$list->caseid}})</option>
            @endforeach
          </select><br>
        @else
                ไม่มีข้อมูลเคสในขณะนี้<br>
        @endif
        <label for="booking_title">หัวข้อการนัด</label><br>
        <input type="text" name="booking_title" max="255" required><br>

        <label for="booking_detail">รายละเอียดการนัด</label><br>
        <textarea name="booking_detail" cols="50" rows="10"></textarea><br>

        <label for="booking_date">วันและเวลาที่นัด</label><br>
        <input type="datetime-local" name="booking_date" required><br>

        <input type="submit" name="booking_submit" value="บันทึก" class="btn btn-plus mt-5">
    </div>
    </form>
</div>
</div>
@endsection