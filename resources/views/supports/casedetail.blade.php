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
            <h3>ประเภทการรักษา</h3>
                <p>{{$case->case_title}}</p>
            <h3>รายละเอียดการรักษา</h3>
                 <ul><li>{{$case->case_detail}}</li></ul> 
            <h3>แพทย์ที่รักษา</h3>@if($case->doctor != NULL){{$case->doctor->name_th}}@else ไม่มีข้อมูลแพทย์ @endif 
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