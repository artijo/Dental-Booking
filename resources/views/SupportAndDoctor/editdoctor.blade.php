@extends('layouts.global')
@section('title') แก้ไขข้อมูลแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>แก้ไขข้อมูลแพทย์</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{ url('/admin/doctor/update/'.$doctor->doctor_id) }}" method="POST" class="add-data">
    @csrf
    @method('PUT')
    <div class="add-data-item">
        <label for="name_en">ขื่อ(ภาษาอังกฤษ)</label>
        <input type="text" name="name_en" value="{{$doctor->name_en}}" max="255" pattern="[a-zA-Z]+"> <br>
        <label for="lastname_en">นามสกุล(ภาษาอังกฤษ)</label>
        <input type="text" name="lastname_en" value="{{$doctor->name_en}}" max="255" pattern="[a-zA-Z]+"> <br>
        <label for="name_th">ชื่อ(ภาษาไทย ไม่ต้องมีคำนำหน้าชื่อ)</label>
        <input type="text" name="name_th" value="{{$doctor->name_th}}" max="255" pattern="[\u0E00-\u0E7F]+" required> <br>
        <label for="lastname_th">นามสกุล(ภาษาไทย)</label>
        <input type="text" name="lastname_th" value="{{$doctor->lastname_th}}" max="255" pattern="[\u0E00-\u0E7F]+" required> <br>
        <div class="error-form">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <label for="email">อีเมล</label>
        <input type="email" name="email" value="{{$doctor->email}}" max="255" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required> <br>
    </div>
    <div class="add-data-item">
        @if(session()->has('error'))
            {{ session()->get('error') }}
        @endif
        <div class="error-form">
            @error('password')
                {{ $message }}
            @enderror
        </div>
        <label for="password">รหัสผ่าน</label>
        <input type="password" name="password" minlength="8" required> <br>
        <label for="password">ยืนยันรหัสผ่าน</label>
        <input type="password" name="password_cf" required> <br>
        <div class="error-form">
            @error('tel')
                {{ $message }}
            @enderror
        </div>
        <label for="tel">เบอร์โทรศัพท์</label>
        <input type="text" name="tel" value="{{$doctor->tel}}" pattern="[0-9]{10}" required> <br>
        <label for="specialist_id">ความเชี่ยวชาญ</label>
        @if(!empty($spacialist) && count($spacialist) > 0)
            <select name="specialist_id[]" id="specialist" multiple class="specailist">
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