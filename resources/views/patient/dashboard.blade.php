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
        <h1 class="text-2xl mt-5">เคสล่าสุด</h1>
        <table class='table-show'>
            <tr>
                <th>รายการ</th>
                <th>รายละเอียด</th>
                <th colspan="2">วันที่นัด</th>
            </tr>
            @if(!empty($lastbooking) && $lastbooking->case->case_status!=3)
            <tr>
                <td>{{$lastbooking->booking_title}}</td>
                <td>{{$lastbooking->booking_detail}}</td>
                <td>{{date('d M Y',strtotime($lastbooking->booking_date))}}</td>
                <td><a href="{{url('/user/case/'.$lastbooking->caseid)}}">รายละเอียดการนัด</a></td>
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
                        <th>วันที่</th>
                        <th>รายละเอียด</th>
                        <th colspan="2">สถานะการนัด</th>
                        @if(!empty($cases) && count($cases) > 0 && $lastbooking->case->case_status==3)
                                @foreach($cases as $case)
                                    <tr>
                                        <td>{{$cases->firstItem()+$loop->index}}</td>
                                        <td><a href="{{url('/user/case/'.$case->caseid)}}">{{$case->case_title}}</td>
                                        <td>{{date('d M Y',strtotime($case->created_at))}}</td>
                                        <td>{{$case->case_detail}}</td>
                                        <td class="flex gap-2">@if($case->case_status == 1) <img src="{{asset('img/icon/clock.svg')}}" alt="wait"> <span>กำลังรักษา</span> @elseif($case->case_status==2) <img src="{{asset('img/icon/floppy.svg')}}" alt="cancel"><span>การรักษาไม่เสร็จสมบูรณ์</span>@elseif($case->case_status==3) <img src="{{asset('img/icon/check-circle.svg')}}" alt="finish"><span>เสร็จสิ้น</span> @endif</td>
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