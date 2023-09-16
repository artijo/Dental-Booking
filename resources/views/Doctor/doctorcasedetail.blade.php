@extends('layouts.global')
@section('title') ข้อมูลเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลเคสการรักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/case/edit/'.$case->caseid)}}"><button class="btn btn-edit">แก้ไข</button></a>
    </div>
    <div class="content">
        <div class="head">
            <h3>รหัสผู้ป่วย : {{$case->patient->idcard}}</h3>
        </div>
        <div class="body">

    ชื่อผู้ป่วย : {{$case->patient->name_th}} {{$case->patient->lastname_th}} <br>

    หัวข้อการรักษา : {{$case->case_title}} <br>
    รายละเอียดการรักษา : {{$case->case_detail}} <br>
    สถานะการรักษา : @if($case->case_status === 1)รอเข้าพบ @elseif($case->case_status === 2)ไม่มาพบตามนัด @elseif($case->case_status === 3)เสร็จสิ้น@endif <br>
    การนัด
    <table class="table-show">
        <tr>
            <th>หัวข้อการนัด</th>
            <th>รายละเอียดการนัด</th>
            <th colspan='2'>วันที่นัด</th>
        </tr>
    
   
    @foreach ($case->bookings as $item)
    <tr>
        <td>{{$item->booking_title}}</td>
        <td>{{$item->booking_detail}}</td>
        <td>{{$item->booking_date}}</td>
        <td><a href="{{url('/admin/case/edit/'.$case->caseid)}}"><button>แก้ไข</button></a></td>
    </tr>

    @endforeach
    </table>
    </div>
    </div>
</div>
</div>
@endsection

