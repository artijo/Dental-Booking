@extends('layouts.global')
@section('title') รายชื่อผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษา</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}} " class="current">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" >รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="">รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
</nav>
<div class="content-dashboard">
    @if($support->level === 0)
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/patient/edit/'.$patient->idcard)}}"><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
        <a href=""><button class="btn btn-delete">ลบข้อมูล</button></a>
    </div>
    @endif
    <div class="content">
        <div class="head">
            <h3>รหัสบัตรประจำตัวประชาชน (IDCard): <span class="font-bold">{{$patient->idcard}}</span></h3>
        </div>
    <div class="body">
    คุุณ {{$patient->name_th}} {{$patient->lastname_th}} <br>
    <span class="font-bold">รหัสบัตรประชาชน</span> {{$patient->idcard}} <br>
    <span class="font-bold">เกิดวันที่</span> {{$patient->birthday}}<br>
    <span class="font-bold">เพศ</span> {{$patient->gender}} <br>
    <span class="font-bold">โรคประจำตัว</span>@if($patient->intolerance) {{$patient->intolerance}} @else ไม่มีโรคประจำตัว @endif<br>
    <span class="font-bold">จำนวนการรักษา</span> {{$patient->cases->count()}} ครั้ง <br>
    
    @if($patient->cases->count() > 0)
    <hr>
    <h2>ประวัติการรักษา</h2>
    <table>
        <tr>
            <th>รายการ</th>
            <th colspan="2">สถานะ</th>
        </tr>
    @foreach ($patient->cases as $item)
    <tr>
        <td>{{$item->case_title}}</td>
        <td> @if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif</td>
        <td><a href="{{url('/admin/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
    </tr>
    @endforeach
    </table>
    @endif
    </div>
</div>
</div>
</div>
@endsection