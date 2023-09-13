@extends('layouts.global')
@section('title') รายชื่อแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อแพทย์</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" class="current">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>เบอร์โทรศัพท์</th>
            <th>จำนวนการรักษา(ครั้ง)</th>
            <th>รายละเอียดเพิ่มเติม</th>
        </tr>
        @foreach($count as $case)
        @if($case->casetotal != null)
        <tr>
            <td>{{$count->firstItem()+$loop->index}}</td><td>{{$case->fullname}}</td><td>{{$case->tel}}</td><td>{{$case->casetotal}}</td>
            <td><a href="{{url('/admin/showdoctor/'.$case->doctorid)}}">รายละเอียดเพิ่มเติม</a></td>
        </tr>
        @else
        <tr>
            <td>{{$count->firstItem()+$loop->index}}</td><td>{{$case->fullname}}</td><td>{{$case->tel}}</td><td>0</td>
            <td><a href="{{url('/admin/showdoctor/'.$case->doctorid)}}">รายละเอียดเพิ่มเติม</a></td>
        </tr>
        @endif
        @endforeach
    </table>
</div>
</div>
@endsection