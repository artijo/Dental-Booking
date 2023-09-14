@extends('layouts.global')
@section('title') เข้าสู่ระบบสำหรับผู้ดูแล @endsection
@section('content')
    <table>
        <tr>
            <td>ลำดับ</td>
            <td>รายการ</td>
            <td>สถานะ</td>
        </tr>
    
    @foreach($cases as $item)
            <tr>
                <td>{{$cases->firstItem()+$loop->index}}</td>
                <td>{{$item->case_title}}</td>
                <td>{{$item->tel}}</td>
                <td>@if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif</td>
                <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
    @endforeach
    </table>
@endsection