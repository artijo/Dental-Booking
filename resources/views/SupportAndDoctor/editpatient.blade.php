@extends('layouts.global')
@section('title') แก้ไข้ข้อมูลผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>แก้ไข้ข้อมูลผู้รักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{url('admin/patient/update/'.$patient->idcard)}}" method="post" class="add-data">
        @csrf
        @method('PUT')
        <div class="add-data-item">
            <label for="idcard">บัตรประจำตัวประชาชน</label> <br>
            <input type="number" name="idcard" value="{{$patient->idcard}}" disabled><br>
            <label for="name_th">ชื่อ (ภาษาไทย)</label><br>
            <input type="text" name="name_th" value="{{$patient->name_th}}" max="255" pattern="[\u0E00-\u0E7F]+" required><br>
            <label for="surname_th">นามสกุล (ภาษาไทย)</label><br>
            <input type="text" name="lastname_th" value="{{$patient->lastname_th}}" max="255" pattern="[\u0E00-\u0E7F]+" required><br>
            <label for="name_en">ชื่อ (ภาษาอังกฤษ)</label><br>
            <input type="text" name="name_en" value="{{$patient->name_en}}" max="255" pattern="[a-zA-Z]+"><br>
            <label for="surname_en">นามสกุล (ภาษาอังกฤษ)</label><br>
            <input type="text" name="lastname_en" value="{{$patient->lastname_en}}" max="255" pattern="[a-zA-Z]+"><br>
            <label for="tel">เบอร์โทรศัพท์</label><br>
            <input type="number" name="tel" value="{{$patient->tel}}" pattern="[0-9]{10}" required><br>
        </div>
        <div class="add-data-item">
            <label for="email">อีเมล</label><br>
            <input type="email" name="email" value="{{$patient->email}}" max="255" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$"><br>
            @if($patient->gender === 'male')
            <label for="gender">เพศ</label><br>
            <input type="radio" name="gender" value="male" checked>
            <label for="male">ชาย</label>
            <input type="radio" name="gender" value="female">
            <label for="famale">หญิง</label><br>
            @elseif($patient->gender === 'female')
            <input type="radio" name="gender" value="male">
            <label for="male">ชาย</label>
            <input type="radio" name="gender" value="female" checked>
            <label for="famale">หญิง</label><br>
            @endif
            <label for="birthday">วันเกิด</label><br>
            <input type="date" name="birthday" value="{{$patient->birthday}}" required><br>
            <label for="intolerance">โรคประจำตัว</label><br>
            <input type="text" name="intolerance" value="{{$patient->intolerance}}"><br>
            <input type="submit" value="บันทึกข้อมูล" class="btn btn-plus mt-5">
        </div>
        </form>
</div>
</div>
@endsection