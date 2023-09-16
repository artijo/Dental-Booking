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
            <th>ลำดับ</th>
            <th>รายการนัด</th>
            <th>รายละเอียดการนัด</th>
            <th colspan="2">วันที่นัด</th>
        </tr>
        @if(count($booking) <= 0)
            <tr>
                <td colspan="5" class="text-center">ไม่มีข้อมูลการนัด</td>
            </tr>
        @else
        @foreach($booking as $bk)
            @foreach($bk->bookings as $item)
            <tr>
                <td>{{$booking->firstItem()+$loop->index}}</td>
                <td>{{$item->booking_title}}</td>
                <td>{{$item->booking_detail}}</td>
                <td>{{$item->booking_date}}</td>
                <td><a href="{{url('/admin/booking/edit/'.$item->booking_id)}}">แก้ไข</a></td>
            </tr>
            @endforeach
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
            text: 'ทำรายการสำเร็จ',
            confirmButtonText: 'ตกลง'
        })
    </script>
@endif
@endsection