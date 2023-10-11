@extends('layouts.global')
@section('title') รายชื่อผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษา</h1></div>
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
        <th>ชื่อ นามสกุล</th>
        <th>เบอร์โทรศัพท์</th>
        <th>จำนวนการรักษา</th>
    </tr>
    @if(count($page) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลผู้รักษา</td>
        </tr>
    @else
          @foreach ( $page as $pt) 
                <tr>
                <td>{{$page->firstItem()+$loop->index}}</td>
                <td><a href="{{url('/admin/patient/'.$pt->idcard)}}">{{$pt->name_th}} {{$pt->lastname_th}}</a></td>
                <td>{{$pt->tel}}</td>
                <td>{{count($pt->cases)}}</td>
                </tr>
        @endforeach
    </table>
 {{$page}}
    @endif
 
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