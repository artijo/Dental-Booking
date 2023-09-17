@extends('layouts.global')
@section('title') เพิ่มข้อมูลแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เพิ่มข้อมูลแพทย์</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{route('doctor.storedoctor')}}" method="POST" class="add-data">
    @csrf
    <div class="add-data-item">
        <label for="name_th">ชื่อ(ภาษาไทย ไม่ต้องมีคำนำหน้าชื่อ)</label>
        <input type="text" name="name_th" max="255" pattern="[\u0E00-\u0E7F]+" required> <br>
        <label for="lastname_th">นามสกุล(ภาษาไทย)</label>
        <input type="text" name="lastname_th" max="255" pattern="[\u0E00-\u0E7F]+" required> <br>
        <label for="name_en">ขื่อ(ภาษาอังกฤษ)</label><br>
        <input type="text" name="name_en" max="255" pattern="[a-zA-Z]+"> <br>
        <label for="lastname_en">นามสกุล(ภาษาอังกฤษ)</label>
        <input type="text" name="lastname_en" max="255" pattern="[a-zA-Z]+"> <br>
        <div class="error-form">
            @error('email')
                {{ $message }}
            @enderror

        </div>
        <label for="email">อีเมล</label><br>
        <input type="text" name="email" max="255" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required> <br>
    </div>
    <div class="add-data-item">
        <div class="error-form">
            @error('password')
                {{ $message }}
            @enderror
        </div>
        <label for="password">รหัสผ่าน</label><br>
        <input type="password" name="password" required> <br>
        <label for="password">ยืนยันรหัสผ่าน</label><br>
        <input type="password" name="password_cf" required> <br>
        <div class="error-form">
            @error('tel')
                {{ $message }}
            @enderror
        </div>
        <label for="tel">เบอร์โทรศัพท์</label><br>
        <input type="text" name="tel" pattern="[0-9]{10}"> <br>
        <label for="specialist_id">ความเชี่ยวชาญ</label><br>
        @if(!empty($spacialist) && count($spacialist) > 0)
            <select class="specailist" name="specialist_id[]" id="specialist" multiple="multiple" >
                @foreach($spacialist as $list)
                <option value="{{ $list->specialist_id }}">{{ $list->name_th }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <input type="submit" value="บันทึกข้อมูล" class="btn btn-plus mt-5">
    </div>
    </form>
</div>
</div>
    @endsection