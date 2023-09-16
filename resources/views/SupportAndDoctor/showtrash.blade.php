@extends('layouts.global')
@section('title') ถังขยะ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายการขยะทั้งหมด</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    @if(!empty($patient) && COUNT($patient) > 0)
    <table class="table-show">
        <tr>
            <th>รหัสบัตรประชาชน</th>
            <th>ชื่อ-นามสกุล</th>
            <th>อี-เมล</th>
            <th>เบอร์โทรศัพท์</th>
            <th>วันเกิด</th>
        </tr>
        @foreach($patient as $list)
        <tr>
            <td>{{$list->idcard}}</td>
            <td>{{$list->name_th}} {{$list->lastname_th}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->tel}}</td>
            <td>{{$list->birthday}}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($doctor) && COUNT($doctor) > 0)
    <table class="table-show">
        <tr>
            <th>รหัสทันตแพทย์</th>
            <th>ชื่อ-นามสกุล</th>
            <th>อี-เมล</th>
            <th>เบอร์โทรศัพท์</th>
        </tr>
        @foreach($doctor as $list)
        <tr>
            <td>{{$list->doctor_id}}</td>
            <td>{{$list->name_th}} {{$list->lastname_th}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->tel}}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($case) && COUNT($case) > 0)
    <table class="table-show">
        <tr>
            <th>รหัสเคส</th>
            <th>หัวเรื่อง</th>
            <th>รายละเอียด</th>
            <th>สถานะการนัด</th>
            <th>รหัสทันตแพทย์</th>
        </tr>
        @foreach($case as $list)
        <tr>
            <td>{{$list->caseid}}</td>
            <td>{{$list->case_title}}</td>
            <td>{{$list->case_detail}}</td>
            <td> @if($list->case_status === 1)รอเข้าพบ 
                @elseif($list->case_status === 2)ไม่มาพบตามนัด 
                @elseif($list->case_status === 3)เสร็จสิ้น
                @endif</td>
            <td>{{$list->doctor_id}}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($booking) && COUNT($booking) > 0)
    <table class="table-show">
        <tr>
            <th>รหัสตารางนัด</th>
            <th>รหัสเคส</th>
            <th>หัวเรื่อง</th>
            <th>วันเวลาที่นัดหมาย</th>
        </tr>
        @foreach($booking as $list)
        <tr>
            <td>{{$list->booking_id}}</td>
            <td>{{$list->caseid}}</td>
            <td>{{$list->booking_title}}</td>
            <td>{{$list->booking_date}}</td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
    
</div>

@endsection