@extends('layouts.global')
@section('title') เพิ่มเคสการรักษา @endsection
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
                url:'/admin/addcase/filter',
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
    <div class="head-title"><h1>เพิ่มเคสการรักษา</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    <form action="{{route('admin.storecase')}}" method="POST" class="add-data">
        @csrf
        <div class="add-data-item">
        <label for="idcard">ผู้เข้ารับการรักษา</label><br>
        <select class="selectidcard" name="idcard">
            @foreach($patient as $list)
            <option value="{{$list->idcard}}">{{ $list->name_th }} {{$list->lastname_th}}</option>
            @endforeach
          </select><br>
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" max="255" required><br>
        <label for="casetype_id">รูปแบบการรักษา</label><br>
        @if(!empty($case_type) && count($case_type) > 0)
            <select name="casetype_id" id="casetype" class="casetype">
                <option value="{{0}}" disabled selected>เลือกประเภทการรักษา</option>
                @foreach($case_type as $list)
                <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <input type="text" name="case_detail"><br>
        <label for="doctor_id">รับผิดชอบโดยแพทย์</label><br>
        @if(!empty($doctor) && count($doctor) > 0)
        <select class="doctor" name="doctor_id">
            <option value="0" disabled='true' selected>เลือกหมอ</option>
          </select>
          <br>
         @else
            ไม่มีข้อมูลแพทย์ในขณะนี้<br>
        @endif
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status">
            <option value="1" selected>กำลังรักษา</option>
            <option value="2">ไม่เสร็จ (ผู้ป่วยไม่มาตามนัด)</option>
            <option value="3">ปิดเคส (เสร็จสิ้น)</option>
        </select><br>
        <input type="submit" value="เพิ่มข้อมูล" class="btn btn-plus mt-5">
    </div>
    </form>
    
</div>
</div>
@endsection