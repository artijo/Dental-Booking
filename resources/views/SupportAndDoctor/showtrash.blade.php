@extends('layouts.global')
@section('title') ถังขยะ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายการขยะทั้งหมด</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    @if(!empty($patient) && COUNT($patient) > 0)
    <h2 class="text-2xl">ผู้รักษา</h2>
    <table class="table-show mb-5">
        <tr>
            <th>รหัสบัตรประชาชน</th>
            <th>ชื่อ-นามสกุล</th>
            <th>อีเมล</th>
            <th>เบอร์โทรศัพท์</th>
            <th colspan="3">วันเกิด</th>
        </tr>
        @foreach($patient as $list)
        <tr>
            <td>{{$list->idcard}}</td>
            <td>{{$list->name_th}} {{$list->lastname_th}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->tel}}</td>
            <td>{{date('d M Y',strtotime($list->birthday))}}</td>
            <td><a href="{{url('/admin/restore/patient/'.$list->idcard)}}" onclick="confrimation_restore(event)">กู้ข้อมูล</a></td>
            <td><a href="{{url('/admin/delete/patient/'.$list->idcard)}}" onclick="confrimation_delete(event)">ลบข้อมูล</a></td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($doctor) && COUNT($doctor) > 0)
    <h2 class="text-2xl">แพทย์</h2>
    <table class="table-show mb-5">
        <tr>
            <th>รหัสทันตแพทย์</th>
            <th>ชื่อ-นามสกุล</th>
            <th>อี-เมล</th>
            <th colspan="3">เบอร์โทรศัพท์</th>
        </tr>
        @foreach($doctor as $list)
        <tr>
            <td>{{$list->doctor_id}}</td>
            <td>{{$list->name_th}} {{$list->lastname_th}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->tel}}</td>
            <td><a href="{{url('/admin/restore/doctor/'.$list->doctor_id)}}" onclick="confrimation_restore(event)">กู้ข้อมูล</a></td>
            <td><a href="{{url('/admin/delete/doctor/'.$list->doctor_id)}}" onclick="confrimation_delete(event)">ลบข้อมูล</a></td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($case) && COUNT($case) > 0)
    <h2 class="text-2xl">เคสการรักษา</h2>
    <table class="table-show mb-5">
        <tr>
            <th>รหัสเคส</th>
            <th>หัวเรื่อง</th>
            <th>สถานะการนัด</th>
            <th colspan="3">รหัสทันตแพทย์</th>
        </tr>
        @foreach($case as $list)
        <tr>
            <td>{{$list->caseid}}</td>
            <td>{{$list->case_title}}</td>
            <td> @if($list->case_status === 1)รอเข้าพบ 
                @elseif($list->case_status === 2)ไม่มาพบตามนัด 
                @elseif($list->case_status === 3)เสร็จสิ้น
                @endif</td>
            <td>{{$list->doctor_id}}</td>
            <td><a href="{{url('/admin/restore/case/'.$list->caseid)}}" onclick="confrimation_restore(event)">กู้ข้อมูล</a></td>
            <td><a href="{{url('/admin/delete/case/'.$list->caseid)}}" onclick="confrimation_delete(event)">ลบข้อมูล</a></td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($booking) && COUNT($booking) > 0)
    <h2 class="text-2xl">การนัด</h2>
    <table class="table-show mb-5">
        <tr>
            <th>รหัสตารางนัด</th>
            <th>รหัสเคส</th>
            <th>หัวเรื่อง</th>
            <th colspan="3">วันเวลาที่นัดหมาย</th>
        </tr>
        @foreach($booking as $list)
        <tr>
            <td>{{$list->booking_id}}</td>
            <td>{{$list->caseid}}</td>
            <td>{{$list->booking_title}}</td>
            <td>{{date('d M Y H:m:s',strtotime($list->booking_date))}}</td>
            <td><a href="{{url('/admin/restore/booking/'.$list->booking_id.'/'.$list->caseid)}}" onclick="confrimation_restore(event)">กู้ข้อมูล</a></td>
            <td><a href="{{url('/admin/delete/booking/'.$list->booking_id)}}" onclick="confrimation_delete(event)">ลบข้อมูล</a></td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($support) && COUNT($support) > 0)
    <h2 class="text-2xl">ผู้ดูแล</h2>
    <table class="table-show">
        <tr>
            <th>รหัสผู้ดูแล</th>
            <th>ชื่อ</th>
            <th colspan="3">ระดับ</th>
        </tr>
        @foreach($support as $list)
        <tr>
            <td>{{$list->support_id}}</td>
            <td>{{$list->name}}</td>
            <td>@if($list->level == 0)ผู้ดูแลระบบ@else เจ้าหน้าที่ @endif</td>
            <td><a href="{{url('/admin/restore/support/'.$list->support_id)}}" onclick="confrimation_restore(event)">กู้ข้อมูล</a></td>
            <td><a href="{{url('/admin/delete/support/'.$list->support_id)}}" onclick="confrimation_delete(event)">ลบข้อมูล</a></td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
    
</div>
<script>
     function confrimation_restore(ev){
        ev.preventDefault();
        var urlto = ev.currentTarget.getAttribute('href');

        Swal.fire({
            title: 'คุณต้องการกู้คืนข้อมูลหรือไม่?',
            text: "หากกู้คืนแล้วจะสามารถใช้งานได้ตามปกติ",
            icon: 'warning',
            dangerMode: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if(result.value){
                    window.location.href = urlto;
                }
        })
    }
    function confrimation_delete(ev){
        ev.preventDefault();
        var urlto = ev.currentTarget.getAttribute('href');

        Swal.fire({
            title: 'คุณต้องการลบข้อมูลถาวรหรือไม่?',
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