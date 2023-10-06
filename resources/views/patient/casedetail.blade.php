@extends('layouts.global')
@section('title') รายละเอียดตารางนัด @endsection
@section('content')
<div class="patient">
    <div class="a-container">
        <div class="space"></div>
        <div class="space"></div>
        <div class="head-pt flex justify-between items-center">
            <p class="text-xl">สวัสดีคุณ <span class="font-bold">{{$user->name_th}} {{$user->lastname_th}}</span></p>
            <a  href="{{route('patient.logout')}}" class="btn btn-logout">ออกจากระบบ</a>
        </div>
                <div class="content mt-5">
                 <div class="head">
                    <span class="title-pt">รหัสการรักษา:{{$case->caseid}} <span class="title-pt">รหัสผู้ป่วย:{{$case->patient->idcard}}</span></span> 
                 </div>
                <div class="box-casedetail">
                <p><span class="font-bold">หัวข้อการรักษา:</span> {{$case->case_title}}</p>
                <p><span class="font-bold">รายละเอียด: </span>{{$case->case_detail}}</p>
                <p><span class="font-bold">แพทย์ที่รักษา: </span>{{$case->doctor->name_th}} {{$case->doctor->lastname_th}}</p>
                 <p><span class="font-bold">สถานะการนัด: </span>@if($case->case_status === 1)รอเข้าพบ 
                     @elseif($case->case_status === 2)ไม่มาพบตามนัด 
                      @elseif($case->case_status === 3)เสร็จสิ้น
                     @endif</p>
                    <p><span class="font-bold">วันที่เริ่มรักษา: </span>{{date('d M Y',strtotime($case->created_at))}}</p>
                    <div class="space"></div>
                    <hr>
                <h2 class="mt-3 text-xl">วันที่นัดหมาย</h2>
                <table class="table-show">
                    <tr>
                        <th>เรื่องการนัด</th>
                        <th>วันที่นัดหมาย</th>
                    </tr>
                    @php
                        $bookings = $case->bookings()->orderBy('booking_id', 'DESC')->get();
                    @endphp
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking->booking_title}}</td>
                        <td>{{date('d M Y',strtotime($booking->booking_date))}}</td>
                    </tr>
                @endforeach
                </table>
               
                </div>
         </div>
         <div class="space"></div>
    </div>
</div>
   
@endsection