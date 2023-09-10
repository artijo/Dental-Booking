@extends('layouts.global')
@section('title') ตารางนัด @endsection
@section('content')
<div class='patient'>
        <div class='detail'>
            <ul>
                <li><a href="<?php echo route('patient.login')?>">นัดผู้ป่วยทันตกรรม</a></li>
                <li><a href="{{route('patient.logout')}}">ออกจากระบบ</a></li>
            </ul>
        </div>
                @foreach($name as $lname)
                @if($lname->gender === "male")
                <p>นาย {{$lname->name_th}} {{$lname->lastname_th}}</p>
                @else
                <p>นาง {{$lname->name_th}} {{$lname->lastname_th}}</p>
                @endif
                @endforeach
                <p>ประวัติ-ตารางเวลานัดหมาย</p>
                    <table class='fixed'>
                        <th>รายการ</th>
                        <th>วันที่นัดหมาย</th>
                        <th>รายละเอียด</th>
                        <th>สถานะการนัด</th>
                        @if(!empty($booking) && count($booking) > 0)
                                @foreach($booking as $list)
                                    <tr>
                                        <td>{{$list->case_title}}</td>
                                        <td>{{$list->doctor_id}}</td>
                                        <td>{{$list->case_detail}}</td>
                                        <td>{{$list->case_status}}</td>
                                    </tr>
                                @endforeach
                @else
                    <tr>
                        <td colspan="4"><center>ไม่มีการลงเวลานัด</center></td>
                    </tr>
                @endif
                </table>

    </div>
@endsection