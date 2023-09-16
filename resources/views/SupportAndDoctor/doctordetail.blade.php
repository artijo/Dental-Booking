@extends('layouts.global')
@section('title') ข้อมูลแพทย์ @endsection
@section('content')
<div class="a-container">
    <div class="space"></div>
    <div class="head-title"><h1>ข้อมูลแพทย์</h1></div>
    <div class="space"></div>
@include('components.adminanddoctornav')
<div class="content-dashboard">
    @if($support->level === 0)
    <div class="flex justify-end gap-5 mb-5">
        <a href="{{url('/admin/doctor/edit/'.$doctor->doctor_id)}}"><button class="btn btn-edit">แก้ไขข้อมูล</button></a>
        <a href="{{url('/admin/doctor/delete/'.$doctor->doctor_id)}}" onclick="confrimation(event)"><button class="btn btn-delete">ลบข้อมูล</button></a>
    </div>
    @endif
    <div class="content">
        <div class="head">
            <h3>รหัสทันตแพทย์(ID):{{$doctor->doctor_id}}</h3>
        </div>
    <div class="body">
    ชื่อ-นามสกุล: ทพ.{{$doctor->name_th}} {{$doctor->lastname_th}}<br>
    Fullname: DR.{{$doctor->name_en}} {{$doctor->lastname_en}}<br>
    <h3>ข้อมูลการติดต่อ(Contact)</h3>
    อีเมล: {{$doctor->email}}<br>
    เบอร์โทรศัพท์: {{$doctor->tel}}<br>
    <h3>ความเชี่ยวชาญเฉพาะทาง(Specialist)</h3>
    <ul>
        @foreach($doctor->specialists as $special)
        <li>{{$special->name_th}}</li>
        @endforeach
    </ul>
</div>
</div>
    </div>
    </div>
    @if(session('success'))
    <script>
        swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: '{{session("success")}}',
            showConfirmButton: true,
        })
    </script>  
    @endif
    <script>
        function confrimation(ev){
            ev.preventDefault();
            var urlto = ev.currentTarget.getAttribute('href');
    
            Swal.fire({
                title: 'คุณต้องการลบข้อมูลหรือไม่?',
                text: "หากลบแล้วจะไม่สามารถกู้คืนได้",
                icon: 'warning',
                dangerMode: true,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if(result.value){
                        window.location.href = urlto;
                    }
            })
        }
    </script>
@endsection