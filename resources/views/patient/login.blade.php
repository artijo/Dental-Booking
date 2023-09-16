@extends('layouts.global')
@section('title') เข้าสู่ระบบ @endsection
@section('content')
    <div class="patient">
        <div class="a-container">
            <div class="login">
                <div class="detail">
                    <h1 class="title-login">เข้าสู่ระบบ</h1>
                    <p>หากไม่พบข้อมูลโปรดติดต่อเจ้าหน้าที่</p>
                </div>
                @error('idcard')
                <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'เข้าสู่ระบบไม่สำเร็จ',
                    text: '{{ $message }}',
            })
                </script>
                @enderror
                <form action="{{Route('patient.checklogin')}}" method="post">
                    @csrf
                    <label for="idcard">หมายเลขบัตรประชาชน</label><br>
                    <input type="number" name="idcard" placeholder="หมายเลขบัตรประชาชน 13 หลัก" pattern="[0-9]{13}"><br>
                    <label for="phone">เบอร์โทรศัพท์</label><br>
                    <input type="tel" name="phone" placeholder="หมายเลขโทรศัพท์" pattern="[0-9]{10}">
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
        text: 'หมายเลขโทรศัพท์หรือหมายเลขบัตรประชาชนไม่ถูกต้อง',
})
    </script>
@endif
@endsection