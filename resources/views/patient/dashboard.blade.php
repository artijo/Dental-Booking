@extends('layouts.global')
@section('title') ตารางนัด @endsection
@section('content')
<div class='patient'>
<div class="a-container">

        <div class='detail'>
            <ul>
                <li><a href="{{route('patient.logout')}}">ออกจากระบบ</a></li>
            </ul>
        </div>
                <p>สวัสดีคุณ {{$user->name_th}} {{$user->lastname_th}}</p>
                <p>ประวัติ-ตารางเวลานัดหมาย</p>
                    <table class='table-show'>
                        <th>รายการ</th>
                        <th>วันที่นัดหมาย</th>
                        <th>รายละเอียด</th>
                        <th colspan="2">สถานะการนัด</th>
                        @if(!empty($cases) && count($cases) > 0)
                                @foreach($cases as $case)
                                @foreach($case->bookings as $booking)
                                    <tr>
                                        <td>{{$case->case_title}}</td>
                                        <td>{{$booking->booking_date}}</td>
                                        <td>{{$case->case_detail}}</td>
                                        <td>{{$case->case_status}}</td>
                                        <td><a href="{{url('/user/case/'.$case->caseid)}}">รายละเอียด</a></td>
                                    </tr>
                                    @endforeach
                                @endforeach
                @else
                    <tr>
                        <td colspan="4"><center>ไม่มีการลงเวลานัด</center></td>
                    </tr>
                @endif
                </table>

    </div>
    </div>
@endsection