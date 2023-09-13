@extends('layouts.global')
@section('title') DashBoard For Support And Admin @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษา</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}" class="current">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <table class="table-show">
        <tr>
        <th>รายการ</th>
        <th>วันที่นัดหมาย</th>
        <th>รายละเอียด</th>
        <th>สถานะการนัด</th>
        <th>หมายเหตุ</th>
        </tr>
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
    </table>
</div>
</div>
@endsection