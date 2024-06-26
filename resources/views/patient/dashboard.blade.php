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
                <th>ชื่อการนัด</th>
                <th>รายการ</th>
                <th>รายละเอียดการนัด</th>
                <th colspan="2">วันที่นัด</th>
            </tr>
            @if(!empty($lastbooking) && $lastbooking->case->case_status!=3 && $lastbooking->case->case_status!=2)
            <tr>
                <td>{{$lastbooking->booking_title}}</td>
                <td><a href="{{url('/user/case/'.$lastbooking->caseid)}}">{{$lastbooking->case->case_title}}</a></td>
                <td>{{$lastbooking->booking_detail}}</td>
                <td>{{date('d M Y',strtotime($lastbooking->booking_date))}}</td>
                <td></td>
            </tr>
            @else
            <tr>
                <td colspan="4"><center>ไม่มีการลงเวลานัดล่าสุด</center></td>
            </tr>
            @endif
        </table>  
                <h1 class="text-2xl mt-5">ประวัติการเข้ารับการรักษา</h1>
                    <table class='table-show'>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>แพทย์ที่รักษา</th>
                        <th>วันที่เริ่มรักษา</th>
                        <th>สถานะการนัด</th>
                        @if(!empty($cases) && count($cases))
                                @foreach($cases as $case)
                                    <tr>
                                        <td>{{$cases->firstItem()+$loop->index}}</td>
                                        <td><a href="{{url('/user/case/'.$case->caseid)}}">{{$case->case_title}}</td>
                                        <td>{{$case->doctor->name_th}} {{$case->doctor->lastname_th}}</a></td>
                                        <td>{{date('d M Y',strtotime($case->created_at))}}</td>
                                        {{-- @if($case->case_detail===NULL)
                                        <td>-</td>
                                        @else
                                        <td>{{$case->case_detail}}</td>
                                        @endif --}}
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