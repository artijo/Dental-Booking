@extends('layouts.global')
@section('title') รายละเอียดการรักษา @endsection
@section('content')
<div class="a-container">
        <div class="space"></div>
        <div class="head-title"><h1>รายละเอียดการรักษา</h1></div>
        <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    @if($support->level === 0)
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/case/edit/'.$case->caseid)}}" class="btn btn-edit">แก้ไขข้อมูล</a>
        <a href="{{url('/admin/case/delete/'.$case->caseid)}}" onclick="confrimation(event)" class="btn btn-delete">ลบข้อมูล</a>
    </div>
    @endif
        <div class="content">
        <div class="head">
            <h3>รหัสการรักษา:{{$case->caseid}}</h3>
        </div>
        <div class="body">
                <p><span class="font-bold">เคสการรักษา: </span>{{$case->case_title}}</p>
                <p><span class="font-bold">รายละเอียดการรักษา: </span>{{$case->case_detail}} </p>
            <p><span class="font-bold">แพทย์ที่รักษา: </span>@if($case->doctor != NULL){{$case->doctor->name_th}} {{$case->doctor->lastname_th}}@else ไม่มีข้อมูลแพทย์ @endif</p> 
            <p><span class="font-bold">ผู้ป่วย: </span>@if($case->patient != NULL){{$case->patient->name_th}} {{$case->patient->lastname_th}}@else ไม่มีข้อมูลผู้ป่วย @endif</p>
            <p><span class="font-bold">วันที่เริ่มรักษา: </span>{{date('d-m-Y',strtotime($case->created_at))}}</p>
            <div class="space"></div>
           <h3>วันที่นัดหมาย</h3> 
           <ul>
                @foreach($case->bookings as $time)
                        @if($time->booking_date != NULL) 
                                <li>{{$time->booking_date}} น.</li>
                         @else 
                          ยังไม่ลงเวลานัด
                        @endif
                @endforeach
            </ul>
            <div class="space"></div>
            <p><span class="font-bold">สถานะการรักษา: </span>
             @if($case->case_status === 1)รอเข้าพบ 
                @elseif($case->case_status === 2)ไม่มาพบตามนัด 
                @elseif($case->case_status === 3)เสร็จสิ้น
                @endif
            </p>
                </div>
        </div>
    </div>
          
           
</div>
    
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: '{{session("success")}}',
        showConfirmButton: true,
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