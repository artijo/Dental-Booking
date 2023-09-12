<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Case</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
    <form action="{{route('admin.storecase')}}" method="POST">
        @csrf
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
            <select name="casetype_id" id="casetype">
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
        <select class="selectdoctor" name="doctor_id">
            @foreach($doctor as $list)
            <option value="{{$list->doctor_id}}">{{ $list->name_th }} {{$list->lastname_th}}</option>
            @endforeach
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
        <input type="submit" value="บันทึกเคสการรักษา">
    </form>
    
    <script src="{{asset('js/select2.js')}}"></script>
</body>
</html>