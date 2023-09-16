@extends('layouts.global')
@section('title') ข้อมูลการนัด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลการนัด</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหารายการนัด" value="{{$s}}">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('booking.addbooking')}}"><button class="btn btn-plus">เพิ่มข้อมูลการนัด</button></a>
    </div>
    <table class="table-show">
        <tr>
        <th>รายการ</th>
        <th>วันที่นัดหมาย</th>
        <th>รายละเอียด</th>
        <th @if(session('level')==0) colspan="4" @else colspan="2" @endif>สถานะการนัด</th>
        </tr>
        @if(count($booking) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลการนัด</td>
        </tr>
        @else
        @foreach($booking as $book) 
        <tr>
            <td>{{$book->booking_title}}</td>
            <td>{{date('d M Y',strtotime($book->booking_date))}}
            </td>
            <td>{{$book->booking_detail}}</td>
            <td> @if($book->case->case_status === 1)รอเข้าพบ 
                @elseif($book->case->case_status === 2)ไม่มาพบตามนัด 
                @elseif($book->case->case_status === 3)เสร็จสิ้น
                @endif
                </td>
            <td><a href='{{url('/admin/case/'.$book->case->caseid)}}'>รายละเอียดเคส</a></td>
            @if(session('level') == 0)
            <td><a href="{{url('/admin/booking/edit/'.$book->booking_id)}}">แก้ไข</a></td>
            <td><a href="{{url('/admin/booking/delete/'.$book->booking_id)}}" onclick="confrimation(event)">ลบ</a></td>
            @endif
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
<script>
    function confrimation(ev){
        ev.preventDefault();
        var urlto = ev.currentTarget.getAttribute('href');

        Swal.fire({
            title: 'คุณต้องการลบข้อมูลหรือไม่?',
            text: "หากลบแล้วจะไม่สามารถกู้คืนได้",
            icon: 'warning',
            dangerMode: true,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if(result.value){
                    window.location.href = urlto;
                }
        })
    }
</script>
@endsection