@extends('layouts.global')
@section('title') ตารางนัด @endsection
@section('content')
<div class='patient'>
        <div class='detail'>
            <ul>
                <li><a href="<?php echo route('login')?>">เว็บนัดผู้ป่วยทันตกรรม</a></li>
            </ul>
        </div>
                <p>ประวัติ-ตารางเวลานัดหมาย</p>
                <table class='fixed'>
                    <th>รายการ</th>
                    <th>วันที่นัดหมาย</th>
                    <th>รายละเอียด</th>
                    <th>สถานะการนัด</th>
                    @foreach($info as $list)
                    <tr>
                        <td>{{$list->name}}</td> <!--เข้าถึง Attribute name และ email ของตาราง Customers-->
                        <td>{{$list->email}}</td>
                    </tr>
                    @endforeach
                </table>

    </div>
@endsection