@extends('layouts.global')
@section('title') แก้ไขเคสการรักษา @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>แก้ไขเคสการรักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{url('/admin/case/update/'.$case->caseid)}}" method="POST" class="add-data">
        @csrf
        @method('PUT')
        <div class="add-data-item">
        <label for="idcard">รหัสบัตรประชาชน(ผู้เข้ารับการรักษา)</label><br>
        @if($case->patient)
        <input type="number" name="idcard" value="{{$case->idcard}}" disabled><br>
        @else
        <input type="number" name="idcard" value="ไม่พบข้อมูลผู้เข้ารักษา" placeholder='ไม่พบข้อมูลผู้เข้ารักษา' disabled><br>
        @endif
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" value="{{$case->case_title}}" max="255" required><br>
        <label for="casetype_id">รูปแบบการรักษา</label><br>
        @if(session()->has('case_error'))
        {{session('case_error')}}
        @endif
        @if(!empty($case_type) && count($case_type) > 0)
        <select name="casetype_id" id="casetype" class="casetype">
                <option value="{{$case->casetype_id}}"selected>{{$case->casetype->casetype_name}}</option>
                @foreach($prefix as $item)
                @switch($item)
                    @case('OC')
                    <optgroup label="ทันตกรรมบดเคี้ยว">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('OD')
                    <optgroup label="ทันตกรรมหัตถการ ">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('OM')
                    <optgroup label="เวชศาสตร์ช่องปาก ">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('OS')
                    <optgroup label="ฝ่ายศัลยศาสตร์">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('OT')
                    <optgroup label="ทันตกรรมจัดฟัน">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('PD')
                    <optgroup label="ทันตกรรมประดิษฐ์">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('PK')
                    <optgroup label="ทันตกรรมสำหรับเด็ก">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('PT')
                    <optgroup label="ปริทันตวิทยา">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                        @break
                    @case('RD')
                    <optgroup label="รังสีวิทยา">
                        @foreach($case_type as $list)
                            @php $sp_prefix = substr($list->casetype_id,0,2); @endphp
                            @if($item == $sp_prefix)
                            <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                    @break
                    @default
                @endswitch
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <textarea name="case_detail" rows="10" cols="50">{{$case->case_detail}}</textarea><br>
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        @if($case)
        @if(session()->has('error'))
            <p style="white-space: nowrap;">{{ session()->get('error') }}</p>
        @endif
            <select name="doctor_id" single class="doctor">
                @if($case->doctor)
                @foreach($doctor as $doctors)
                <option value="{{$doctors->doctor_id}}" selected>{{$doctors->name_th}} {{$doctors->lastname_th}}</option>
                @endforeach
                @else
                <option value="0" disabled='true' selected>ถ้าไม่มีหมอจะเลือกหมอให้อัตโนมัติ</option>
                @endif
            </select><br>
        @else
        <input type="text" name="doctor_id" value="ไม่มีข้อมูลทันตแพทย์" disabled><br>
        @endif
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status" required>
            <option value="1">กำลังรักษา</option>
            <option value="2">ยกเลิกเคส</option>
            <option value="3" selected>เสร็จสิ้น</option>
        </select><br>
        <input type="submit" value="บันทึกเคสการรักษา" class="btn btn-plus mt-5">
    </div>
    </form>
</div>
</div>
@endsection