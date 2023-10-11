@extends('layouts.global')
@section('title') เคสการรักษาทั้งหมด @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>เคสการรักษาทั้งหมด</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <div class="mb-3 flex justify-between items-center">
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="ค้นหาเคสการรักษา" value="{{$s}}">
            <input type="submit" value="ค้นหา">
        </form>
        <a href="{{route('patient.addcase')}}"><button class="btn btn-plus">เพิ่มข้อมูลการรักษา</button></a>
    </div>
    <table class="table-show">
        <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>ชื่อ - นามสกุล</th>
            <th>แพทย์ที่รักษา</th>
            <th>วันที่เริ่มรักษา</th>
            <th colspan="2">สถานะ</th>
        </tr>
    @if(count($cases) <= 0)
        <tr>
            <td colspan="5" class="text-center">ไม่มีข้อมูลเคสการรักษา</td>
        </tr>
    @else
    @foreach ($cases as $item)
        <tr>
            <td>{{$cases->firstItem()+$loop->index}}</td>
            <td><a href="{{url('/admin/case/'.$item->caseid)}}">{{$item->case_title}}</a></td>
            <td><a href="{{url('admin/patient/'.$item->idcard)}}">{{$item->patient->name_th}} {{$item->patient->lastname_th}}</a></td>
            <td><a href="{{url('admin/showdoctor/'.$item->doctor_id)}}">{{$item->doctor->name_th}} {{$item->doctor->lastname_th}}</a></td>
            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
            <td>@if($item->case_status === 1)รอเข้าพบ 
                @elseif($item->case_status === 2)ไม่มาพบตามนัด 
                @elseif($item->case_status === 3)เสร็จสิ้น
                @endif</td>
        </tr>
        
    @endforeach
    {{$cases}}
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
@endsection