@extends('layouts.global')
@section('title') รายละเอียดตารางนัด @endsection
@section('content')
<div class="patient">
    <div class="a-container">
                <div class="content">
                <h3 class="title-pt">สวัสดีคุณ {{$user->name_th}}</h3>
                <span class="title-pt">รหัสการรักษา:{{$case->caseid}}</span> 
                <span class="title-pt">รหัสผู้ป่วย:{{$case->patient->idcard}}</span>
                <div class="box-casedetail">
                <h4>หัวข้อการรักษา</h4>
                    <span class="text-dt">{{$case->case_title}}</span>
                <h4>รายละเอียด</h4>
                      <span class="text-dt">{{$case->case_detail}}</span> 
                <h4>แพทย์ที่รักษา</h4>
                        <span class="text-dt">{{$case->doctor->name_th}}</span>
                 <h4>สถานะการนัด</h4>
                 <span class="text-dt"> @if($case->case_status === 1)รอเข้าพบ 
                     @elseif($case->case_status === 2)ไม่มาพบตามนัด 
                      @elseif($case->case_status === 3)เสร็จสิ้น
                     @endif
                    </span>
                    
                <h4>วันที่นัดหมาย</h4>
                <span class="text-dt">  
                    @foreach($case->bookings as $booking)
                {{date('d M Y',strtotime($booking->booking_date))}}
                @endforeach
            </span>
               
                </div>
         </div>
    </div>
</div>
   
@endsection