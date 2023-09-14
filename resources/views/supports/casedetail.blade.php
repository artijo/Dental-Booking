@extends('layouts.global')
@section('title') รายละเอียดการรักษา @endsection
@section('content')
<div class="a-container">
        <div class="space"></div>
        <div class="head-title"><h1>รายละเอียดการรักษา</h1></div>
        <div class="space"></div>
        <nav class="dashboard-nav">
    <ul>
        <li><a href="{{route('admin.index')}}">หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" >รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}" class="current">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
    </ul>
</nav>
<div class="content-dashboard">
    @if($support->level === 0)
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/case/edit/'.$case->caseid)}}"><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
        <a href=""><button class="btn btn-delete">ลบข้อมูล</button></a>
    </div>
    @endif
        <div class="content">
        <div class="head">
            <h3>รหัสการรักษา:{{$case->caseid}}</h3>
        </div>
        <div class="body">
            <h3>ประเภทการรักษา</h3>
                <p>{{$case->case_title}}</p>
            <h3>รายละเอียดการรักษา</h3>
                 <ul><li>{{$case->case_detail}}</li></ul> 
            <h3>แพทย์ที่รักษา</h3>{{$case->doctor->name_en}} 
           <h3>วันที่นัดหมาย</h3> 
                @foreach($case->bookings as $time)
                        @if($time->booking_date != NULL) 
                                {{$time->booking_date}} น.
                         @else 
                          ยังไม่ลงเวลานัด
                        @endif
                @endforeach  <br>
            สถานะการรักษา <br>
             @if($case->case_status === 1)รอเข้าพบ 
                @elseif($case->case_status === 2)ไม่มาพบตามนัด 
                @elseif($case->case_status === 3)เสร็จสิ้น
                @endif
                </div>
        </div>
    </div>
          
           
</div>
    


@endsection