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
        <li><a href="{{route('patientlist.showpatient')}} ">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" >รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="{{route('admin.showsupport')}}" class="current">รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาผู้ดูแล" value="{{$s}}">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('admin.addsupport')}}"><button class="btn btn-plus">เพิ่มข้อมูลผู้ดูแล</button></a>
    </div>
    <table class="table-show">
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>เบอร์โทรศัพท์</th>
        <th>อีเมล</th>
        <th colspan="3">ระดับสิทธ์การเข้าถึง</th>
    </tr>
    @if(count($supports) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลผู้รักษา</td>
        </tr>
    @else
          @foreach ( $supports as $pt) 
                <tr>
                <td>{{$supports->firstItem()+$loop->index}}</td>
                <td>{{$pt->name}}</td>
                <td>{{$pt->tel}}</td>
                <td>{{$pt->email}}</td>
                <td>@if($pt->level == 0)ผู้ดูแลระบบ@else เจ้าหน้าที่ @endif</td>
                <td><a href="{{url('/admin/support/edit/'.$pt->support_id)}}">แก้ไข</a></td>
                <td><a href="{{url('/admin/support/delete/'.$pt->support_id)}}">ลบ</a></td>
                </tr>
        @endforeach
    </table>
 {{$supports}}
    @endif
</div>
</div>
@endsection