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
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาเคสการรักษา">
            <input type="submit" value="ค้นหา">
        </form>
        <a href=""><button class="btn btn-plus">เพิ่มข้อมูลการรักษา</button></a>
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
    @endif
</table>
</div>
</div>
@endsection