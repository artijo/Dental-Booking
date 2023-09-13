<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Detail</title>
</head>
<body>
    <h3>รหัสทันตแพทย์(ID):{{$doctor->doctor_id}}</h3><br>
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
    
</body>
</html>