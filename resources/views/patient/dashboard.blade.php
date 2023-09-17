@extends('layouts.global')
@section('title') ตารางนัด @endsection
@section('content')
<div class='patient'>
<div class="a-container">
        <div class="space"></div>
        <div class="space"></div>
        <div class="head-pt flex justify-between items-center">
            <p class="text-xl">สวัสดีคุณ <span class="font-bold">{{$user->name_th}} {{$user->lastname_th}}</span></p>
            <a  href="{{route('patient.logout')}}" class="btn btn-logout">ออกจากระบบ</a>
        </div>
        <h1 class="text-2xl mt-5">การนัดล่าสุด</h1>
        <table class='table-show'>
            <tr>
                <th>รายการ</th>
                <th>รายละเอียด</th>
                <th>วันที่นัด</th>
            </tr>
            @if(!empty($lastbooking))
            <tr>
                <td>{{$lastbooking->booking_title}}</td>
                <td>{{$lastbooking->booking_detail}}</td>
                <td>{{date('d M Y',strtotime($lastbooking->booking_date))}}</td>
            </tr>
            @else
            <tr>
                <td colspan="3"><center>ไม่มีการลงเวลานัดล่าสุด</center></td>
            </tr>
            @endif
        </table>  
                <h1 class="text-2xl mt-5">ประวัติการเข้ารับการรักษา</h1>
                    <table class='table-show'>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>รายละเอียด</th>
                        <th colspan="2">สถานะการนัด</th>
                        @if(!empty($cases) && count($cases) > 0)
                                @foreach($cases as $case)
                                    <tr>
                                        <td>{{$cases->firstItem()+$loop->index}}</td>
                                        <td>{{$case->case_title}}</td>
                                        <td>{{$case->case_detail}}</td>
                                        <td>@if($case->case_status == 1) กำลังรักษา @elseif($case->case_status==2) การรักษาไม่เสร็จสมบูรณ์ @elseif($case->case_status==3) เสร็จสิ้น @endif</td>
                                        <td><a href="{{url('/user/case/'.$case->caseid)}}">รายละเอียดการนัด</a></td>
                                    </tr>
                                @endforeach
                                {{$cases->links()}}
                @else
                    <tr>
                        <td colspan="4"><center>ไม่มีการลงเวลานัด</center></td>
                    </tr>
                @endif
                </table>

    </div>
    </div>
@endsection