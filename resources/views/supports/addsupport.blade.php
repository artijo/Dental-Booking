@extends('layouts.global')
@section('title') เพิ่มข้อมูลผู้ดูแล @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เพิ่มข้อมูลผู้ดูแล</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{ Route('admin.storesupport') }}" method="post" class="add-data">
        <div class="add-data-item">
        @csrf
        <label for="name">ชื่อ</label><br>
        <input type="text" name="name" placeholder="ชื่อ" max="255" pattern="[\u0E00-\u0E7Fa-zA-Z0-9\s]+" required><br>
        <label for="level">สิทธ์การเข้าถึง</label><br>
        <select name="level" id="level" required>
            <option value="0">ผู้ดูแลระบบ</option>
            <option value="1">เจ้าหน้าที่</option>
        </select><br>
        <label for="tel">เบอร์โทรศัพท์</label><br>
        <input type="text" name="tel" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" required><br>
        <label for="email">อีเมล</label><br>
        <input type="email" name="email" placeholder="อีเมล" max="255" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required><br>
        @if(session()->has('error'))
            {{ session()->get('error') }}
        @endif
        <label for="password">รหัสผ่าน</label><br>
        <input type="password" name="password" placeholder="รหัสผ่าน" required><br>
        <label for="password_confirmation">ยืนยันรหัสผ่าน</label><br>
        <input type="password" name="password_cf" placeholder="ยืนยันรหัสผ่าน" required><br>
        <input type="submit" value="เพิ่มผู้ดูแลระบบ" class="btn btn-plus mt-3">
        </div>
    </form>
</div>
</div>
@endsection