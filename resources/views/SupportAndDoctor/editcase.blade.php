<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/admin/case/update/'.$case->caseid)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="idcard">รหัสบัตรประชาชน(ผู้เข้ารับการรักษา)</label><br>
        <input type="number" name="idcard" value="{{$case->idcard}}" disabled><br>
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title" value="{{$case->case_title}}" max="255" required><br>
        <label for="casetype_id">รูปแบบการรักษา</label><br>
        @if(!empty($case_type) && count($case_type) > 0)
            <select name="casetype_id" id="casetype">
                @foreach($case_type as $list)
                <option value="{{ $list->casetype_id }}">{{ $list->casetype_name }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <label for='case_detail'>รายละเอียดการรักษา</label><br>
        <input type="text" name="case_detail" value="{{$case->case_detail}}"><br>
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        <input type="text" name="doctor_id" value="{{$case->doctor_id}}" disabled><br>
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status" required>
            <option value="1">กำลังรักษา</option>
            <option value="2">ยกเลิกเคส</option>
            <option value="3" selected>เสร็จสิ้น</option>
        </select><br>
        <input type="submit" value="บันทึกเคสการรักษา">
    </form>
</body>
</html>