@extends('layouts.global')
@section('title') รายละเอียดผู้รักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>รายชื่อผู้รักษา</h1></div>
    <div class="space"></div>
    @include('components.adminanddoctornav')
<div class="content-dashboard">
    
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/patient/edit/'.$patient->idcard)}}"><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
    
    </div>
    <div class="content">
        <div class="head">คุณ {{$patient->name_th}} {{$patient->lastname_th}} รหัสบัตรประชาชน <span class="font-bold">{{$patient->idcard}}</span> </div>
        <div class="body">
            <p><span class="font-bold">ชื่อ-สกุล</span> {{$patient->name_th}} {{$patient->lastname_th}} </p>
            <p><span class="font-bold">ชื่อ-สกุล (อังกฤษ): </span> {{$patient->name_en}} {{$patient->lastname_en}}</p>
            <p><span class="font-bold">รหัสบัตรประชาชน: </span> {{$patient->idcard}}</p>
            <p><span class="font-bold">เบอร์โทรศัพท์: </span> {{$patient->tel}}</p>
            <p><span class="font-bold">อีเมล: </span> {{$patient->email}}</p>
            <p><span class="font-bold">เกิดวันที่: </span> {{date('d-m-Y',strtotime($patient->birthday))}}</p>
            <p><span class="font-bold">อายุ: </span> {{date('Y')-date('Y',strtotime($patient->birthday))}} ปี</p>
            <p><span class="font-bold">เพศ: </span> @if($patient->gender === 'male')ชาย @elseif($patient->gender === 'female')หญิง @endif </p>
            <p><span class="font-bold">โรคประจำตัว: </span>@if($patient->intolerance) {{$patient->intolerance}} @else ไม่มีโรคประจำตัว @endif</p>
            <p><span class="font-bold">จำนวนการรักษา: </span> {{$patient->cases->count()}} ครั้ง </p>
    <div class="space"></div>
    <P class="font-bold">ข้อมูลการรักษา</P>
    <table class="table-show">
        <tr>
            <th>รายการ</th>
            <th>รายละเอียด</th>
            <th colspan="2">สถานะ</th>

        </tr>
    @foreach ($patient->cases as $item)
        <tr>
    <td>{{$item->case_title}} </td>
    <td>{{$item->case_detail}} </td>
    <td>@if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif</td>
    <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
    </tr>
    @endforeach
    </table>
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
@endsection