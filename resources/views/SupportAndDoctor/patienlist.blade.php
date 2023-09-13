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
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th colspan="2">เบอร์โทรศัพท์</th>
    </tr>
          @foreach ( $page as $pt) 
                <tr>
                <td>{{$page->firstItem()+$loop->index}}</td>
                <td>{{$pt->name_th}}</td>
                <td>{{$pt->lastname_th}}</td>
                <td>{{$pt->tel}}</td>
                <td><a href='#'>รายละเอียดเพิ่มเติม</a></td>
                </tr>
        @endforeach
    </table>
 {{$page}}
 
</div>
</div> 
@endsection