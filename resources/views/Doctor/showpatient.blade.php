@extends('layouts.global')
@section('title') รายชื่อผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษาของคุณ</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('Doctor')}}">หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}" class="current">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาผู้รักษา">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('patient.addpatient')}}"><button class="btn btn-plus">เพิ่มข้อมูลผู้รักษา</button></a>
    </div>
    @if(!empty($cases) && COUNT($cases) > 0)
    <table class="table-show">
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>หมายเลขโทรศัพท์</th>
                <th colspan="2">จำนวนการรักษา(ครั้ง)</th>
            </tr>
            @foreach($cases as $item)
            <tr>
                <td>{{$cases->firstItem()+$loop->index}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->tel}}</td>
                <td>{{$item->casetotal}}</td>
                <td><a href="{{url('/admin/doctor/patient/'.$item->idcard)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-center">ไม่มีข้อมูลผู้รักษา</td>
            </tr>
    </table>
     
    @endif
</div>
</div>
@endsection