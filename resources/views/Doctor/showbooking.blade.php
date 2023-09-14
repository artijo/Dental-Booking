@extends('layouts.global')
@section('title') บันทึกการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>บันทึกการนัด</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('Doctor')}}">หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}" class="current">บันทึกการนัดของคุณ</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาบันทึกการนัด">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('booking.addbooking')}}"><button class="btn btn-plus">เพิ่มข้อมูลการนัด</button></a>
    </div>
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>รายการนัด</th>
            <th>รายละเอียดการนัด</th>
            <th colspan="2">วันที่นัด</th>
        </tr>
        @if(count($booking) <= 0)
            <tr>
                <td colspan="5" class="text-center">ไม่มีข้อมูลการนัด</td>
            </tr>
        @else
        @foreach($booking as $bk)
            @foreach($bk->bookings as $item)
            <tr>
                <td>{{$booking->firstItem()+$loop->index}}</td>
                <td>{{$item->booking_title}}</td>
                <td>{{$item->booking_detail}}</td>
                <td>{{$item->booking_date}}</td>
                <td><a href="{{url('/admin/doctor/case/'.$item->case->caseid)}}">เพิ่มเติมเกี่ยวกับการนัด</a></td>
            </tr>
            @endforeach
        @endforeach
        {{$booking}}
        @endif
    </table>
</div>
</div>
@endsection