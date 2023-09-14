@extends('layouts.global')
@section('title') ประวัติเคสการรักษาของคุณ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ประวัติเคสการรักษาของคุณ</h1></div>
    <div class="space"></div>
<nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('Doctor')}}">หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}" class="current">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาประวัติการรักษา">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('patient.addcase')}}"><button class="btn btn-plus">เพิ่มข้อมูลการรักษา</button></a>
    </div>
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th colspan="2">สถานะ</th>
        </tr>
    @if(count($cases) <= 0)
        <tr>
            <td colspan="4" class="text-center">ไม่มีข้อมูลเคสการรักษา</td>
        </tr>
    @else
    
    @foreach($cases as $item)
            <tr>
                <td>{{$cases->firstItem()+$loop->index}}</td>
                <td>{{$item->case_title}}</td>
                <td>@if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif</td>
                <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
    @endforeach
    {{$cases}}
    @endif
    </table>
</div>
</div>
@endsection