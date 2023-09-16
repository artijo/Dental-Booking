@extends('layouts.global')
@section('title') เข้าสู่ระบบสำหรับหมอ @endsection
@section('content')
    <div class="supports">
        <div class="a-container">
            <div class="login">
                <div class="detail">
                    <h1 class="title-login">เข้าสู่ระบบ</h1>
                    <p>หากไม่พบข้อมูลโปรดติดต่อเจ้าหน้าที่</p>
                </div>
                
                <form action="{{route('doctor.checklogin')}}" method="post">
                    @csrf
                    <label for="Email">อีเมล</label><br>
                    <input type="email" name="email" placeholder="อีเมล"><br>
                    <label for="Password">รหัสผ่าน</label><br>
                    <input type="password" name="password" placeholder="รหัสผ่าน">
                    <input class="btn btn-login" type="submit" value="เข้าสู่ระบบ">
                </form>
            </div>
            
        </div>
    </div>
    @if(session()->has('error'))
    <script>
        Swal.fire({
        icon: 'error',
        title: 'เข้าสู่ระบบไม่สำเร็จ',
        text: 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
})
    </script>
@endif
@endsection