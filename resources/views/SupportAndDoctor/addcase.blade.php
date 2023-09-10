<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Case</title>
</head>
<body>
    <form action="/admin/addcase" method="POST">
        @csrf
        <label for="idcard">รหัสบัตรประชาชน(ผู้เข้ารับการรักษา)</label><br>
        <input type="number" name="idcard"><br>
        <label for="case_title">หัวเรื่องการรักษา</label><br>
        <input type="text" name="case_title"><br>
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
        <label for="doctor_id">รหัสนายแพทย์</label><br>
        <input type="text" name="doctor_id"><br>
        <label for="case_status">สถานะการรักษา</label><br>
        <select single name="case_status">
            <option value="1" selected>เสร็จสิ้น</option>
            <option value="2">ไม่พบตามนัด</option>
        </select><br>
        <input type="submit" value="บันทึกเคสการรักษา">
    </form>
</body>
</html>