@extends('layouts.global')
@section('title') แก้ไขเคสการรักษา @endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function () {
        $(document).on('change', '.casetype',function () {
        //    console.log('Case change');

           var casetype = $(this).val();
           var prefix = casetype.substr(0,2);
           var div =$(this).parents();
        //    console.log(casetype); 
            $.ajax({
                type:'get',
                url:'/admin/editcase/filter',
                data:{'id':prefix},
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data.length);
                    var doctor_option = " ";
                    doctor_option+='<option value="0" selected disabled>เลือกหมอ</option>';
                    for(var i = 0;i<data.length;i++){
                    doctor_option+='<option value="'+data[i].doctor_id+'">'+data[i].name_th+' '+data[i].lastname_th+'</option>';
                    }

                    $('.doctor').html('');
                    $('.doctor').append(doctor_option);
                },
                error:function(){

                }
            });
        });
    });
</script>
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
        @if(!empty($case_type) && count($case_type) > 0)
            <select name="casetype_id" id="casetype" class="casetype">
                @foreach($case_type as $list)
                <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <textarea rows="10" cols="50">{{$case->case_detail}}</textarea><br>
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        @if($case)
            <select name="doctor_id" single class="doctor">
                @if($case->doctor)
                <option value="{{$case->doctor_id}}" disabled='true' selected>{{$case->doctor->name_th}} {{$case->doctor->lastname_th}}</option>
                @else
                <option value="0" disabled='true' selected>เลือกหมอ</option>
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