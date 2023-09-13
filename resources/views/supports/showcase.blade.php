@extends('layouts.global')
@section('title') เคสการรักษาทั้งหมด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เคสการรักษาทั้งหมด</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}" class="current">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th colspan="2">สถานะ</th>
        </tr>
    
    @foreach ($cases as $item)
        <tr>
            <td>{{$cases->firstItem()+$loop->index}}</td>
            <td>{{$item->case_title}}</td>
            <td>@if($item->case_status === 1)รอเข้าพบ 
                @elseif($item->case_status === 2)ไม่มาพบตามนัด 
                @elseif($item->case_status === 3)เสร็จสิ้น
                @endif</td>
            <td><a href="{{url('/admin/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
        </tr>
        
    @endforeach
    {{$cases}}
</table>
</div>
</div>
@endsection