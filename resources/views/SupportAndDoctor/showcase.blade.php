@extends('layouts.global')
@section('title') ข้อมูลการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลการนัด</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}"  class="current">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหารายการนัด">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('booking.addbooking')}}"><button class="btn btn-plus">เพิ่มข้อมูลการนัด</button></a>
    </div>
    <table class="table-show">
        <tr>
        <th>รายการ</th>
        <th>วันที่นัดหมาย</th>
        <th>รายละเอียด</th>
        <th colspan="2">สถานะการนัด</th>
        </tr>
        @if(count($booking) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลการนัด</td>
        </tr>
        @else
        @foreach($booking as $book) 
        <tr>
            <td>{{$book->booking_title}}</td>
            <td>{{date('d M Y',strtotime($book->booking_date))}}
            </td>
            <td>{{$book->booking_detail}}</td>
            <td> @if($book->case->case_status === 1)รอเข้าพบ 
                @elseif($book->case->case_status === 2)ไม่มาพบตามนัด 
                @elseif($book->case->case_status === 3)เสร็จสิ้น
                @endif
                </td>
            <td><a href='#'>รายละเอียดเพิ่มเติม</a></td>
        </tr> 
       @endforeach
         @endif
    </table>
</div>
</div>
@endsection