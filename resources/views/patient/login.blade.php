@extends('layouts.global')
@section('title') เข้าสู่ระบบ @endsection
@section('content')
    <div class="patient">
        <div class="a-container">
            <div class="login">
                <div class="detail">
                    <h1>เข้าสู่ระบบ</h1>
                    <p>หากไม่พบข้อมูลโปรดติดต่อเจ้าหน้าที่</p>
                </div>
                
                <form action="/booking" method="post">
                    @csrf
                    <label for="idcard">หมายเลขบัตรประชาชน</label><br>
                    <input type="number" name="idcard" placeholder="หมายเลขบัตรประชาชน 13 หลัก" max="13"><br>
                    <label for="phone">เบอร์โทรศัพท์</label><br>
                    <input type="tel" name="phone" placeholder="หมายเลขโทรศัพท์">
                    <input class="btn btn-login" type="submit" value="เข้าสู่ระบบ">
                </form>
            </div>
            
        </div>
    </div>
@endsection