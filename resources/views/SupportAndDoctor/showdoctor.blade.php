@extends('layouts.global')
@section('title') รายชื่อแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อแพทย์</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาแพทย์" value="{{$s}}">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('doctor.adddoctor')}}"><button class="btn btn-plus">เพิ่มข้อมูลแพทย์</button></a>
    </div>
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>เบอร์โทรศัพท์</th>
            <th>จำนวนการรักษา(ครั้ง)</th>
            <th>รายละเอียดเพิ่มเติม</th>
        </tr>
        @if(count($count) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลแพทย์</td>
        </tr>
        @else
        @foreach($count as $case)
        <tr>
            <td>{{$count->firstItem()+$loop->index}}</td>
            <td>{{$case->name_th}} {{$case->lastname_th}}</td>
            <td>{{$case->tel}}</td>
            <td>{{count($case->cases)}}</td>
            <td><a href="{{url('/admin/showdoctor/'.$case->doctor_id)}}">รายละเอียดเพิ่มเติม</a></td>
        </tr>
        @endforeach
        @endif
    </table>
</div>
</div>
@if(session('success'))
    
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: '{{session("success")}}',
            confirmButtonText: 'ตกลง'
        })
    </script>
@endif
@endsection