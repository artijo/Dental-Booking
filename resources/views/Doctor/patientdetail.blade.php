@extends('layouts.global')
@section('title') รายละเอียดผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษา</h1></div>
    <div class="space"></div>
    <nav class="dashboard-nav">
    <ul>
    <li><a href="{{route('Doctor')}}" >หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}" class="current">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/patient/edit/'.$patient->idcard)}}"><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
    
    </div>
    <div class="content">
        <div class="head">คุณ {{$patient->name_th}} {{$patient->lastname_th}} รหัสบัตรประชาชน <span class="font-bold">{{$patient->idcard}}</span> </div>
        <div class="body">
    เกิดวันที่ <br> {{$patient->birthday}} <br> เพศ: {{$patient->gender}} <br>
    โรคประจำตัว {{$patient->intolerance}} <br>
    <h2>ประวัติการรักษา</h2>
    <table>
        <tr>
            <th>รายการ</th>
            <th>รายละเอียด</th>
            <th colspan="2">สถานะ</th>

        </tr>
    @foreach ($patient->cases as $item)
        <tr>
    <td>{{$item->case_title}} </td>
    <td>{{$item->case_detail}} </td>
    <td>@if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif</td>
    <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
    </tr>
    @endforeach
    </table>
    </div>
    </div>
    </div>
</div>
@endsection