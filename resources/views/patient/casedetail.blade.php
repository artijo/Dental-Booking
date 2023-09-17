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
                <h3>หัวข้อการรักษา</h3>
                    <span class="text-dt">{{$case->case_title}}</span>
                <h3>รายละเอียด</h3>
                      <span class="text-dt">{{$case->case_detail}}</span> 
                <h3>แพทย์ที่รักษา</h3>
                        <span class="text-dt">{{$case->doctor->name_th}} {{$case->doctor->lastname_th}}</span>
                 <h3>สถานะการนัด</h3>
                 <span class="text-dt"> @if($case->case_status === 1)รอเข้าพบ 
                     @elseif($case->case_status === 2)ไม่มาพบตามนัด 
                      @elseif($case->case_status === 3)เสร็จสิ้น
                     @endif
                    </span>
                    <h3>วันที่เริ่มรักษา</h3>
                    <span class="text-dt">{{date('d M Y',strtotime($case->created_at))}}</span>
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