@extends('layouts.global')
@section('title') บันทึกการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>บันทึกการนัด</h1></div>
    <div class="space"></div>
    @include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="mb-3 flex justify-end items-center">
        <a href="{{route('booking.addbooking')}}"><button class="btn btn-plus">เพิ่มข้อมูลการนัด</button></a>
    </div>
    <table class="table-show">
        <tr>
            <th>ลำดับที่</th>
            <th>รายการนัด</th>
            <th>เคส</th>
            <th>ชื่อ - สกุลผู้รักษา</th>
            <th>วัน - เวลาที่นัด</th>
            <th colspan="2"></th>
        </tr>
        @if(count($booking) <= 0)
            <tr>
                <td colspan="5" class="text-center">ไม่มีข้อมูลการนัด</td>
            </tr>
        @else
        @foreach($booking as $item)
            <tr>
                <td>{{$booking->firstItem()+$loop->index}}</td>
                <td>{{$item->booking_title}}</td> 
                <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">{{$item->case->case_title}}</a></td>
                <td><a href="{{url('admin/doctor/patient/'.$item->case->idcard)}}">{{$item->case->patient->name_th}} {{$item->case->patient->lastname_th}}</a></td>
                <td>{{date("d-M-Y H:m",strtotime($item->booking_date))}} น.</td>
                <td><a href="{{url('/admin/booking/edit/'.$item->booking_id)}}">แก้ไข</a></td>
            </tr>
        @endforeach
        {{$booking}}
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