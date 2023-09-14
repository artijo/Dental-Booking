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
        <li><a href="{{route('patientlist.showpatient')}}" class="current">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาผู้รักษา" value="{{$s}}">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('patient.addpatient')}}"><button class="btn btn-plus">เพิ่มข้อมูลผู้รักษา</button></a>
    </div>
    <table class="table-show">
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th colspan="2">เบอร์โทรศัพท์</th>
    </tr>
    @if(count($page) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลผู้รักษา</td>
        </tr>
    @else
          @foreach ( $page as $pt) 
                <tr>
                <td>{{$page->firstItem()+$loop->index}}</td>
                <td>{{$pt->name_th}}</td>
                <td>{{$pt->lastname_th}}</td>
                <td>{{$pt->tel}}</td>
                <td><a href="{{url('/admin/patient/'.$pt->idcard)}}">รายละเอียดเพิ่มเติม</a></td>
                </tr>
        @endforeach
    </table>
 {{$page}}
    @endif
 
</div>
</div> 
@endsection