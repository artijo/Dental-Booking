@extends('layouts.global')
@section('title') รายชื่อผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษาของคุณ</h1></div>
    <div class="space"></div>
    @include('components.adminanddoctornav')
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
                <th>หมายเลขโทรศัพท์</th>
                <th colspan="2">จำนวนการรักษา(ครั้ง)</th>
            </tr>
            @if(!empty($cases) && COUNT($cases) > 0)
            @foreach($cases as $item)
            <tr>
                <td>{{$cases->firstItem()+$loop->index}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->tel}}</td>
                <td>{{$item->casetotal}}</td>
                <td><a href="{{url('/admin/doctor/patient/'.$item->idcard)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-center">ไม่มีข้อมูลผู้รักษา</td>
            </tr>
    </table>
     
    @endif
</div>
</div>
@endsection