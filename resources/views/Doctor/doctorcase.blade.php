<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        }
    </style>
</head>
<body>
    <h1>สวัสดี นายแพทย์{{$casedoctor->name_th}} {{$casedoctor->lastname_th}}</h1>
    <h2>นี่คือข้อมูลผู้ป่วยของท่าน</h2>
    <table border=1>
        <thead>
            <tr>
                <td>ลำดับ</td>
                <td>ชื่อ</td>
                <td>หมายเลขโทรศัพท์</td>
                <td>จำนวนการรักษา(ครั้ง)</td>
            </tr>
        </thead>
            @foreach($viewpatient as $item)
            <tr>
                <td>{{$viewpatient->firstItem()+$loop->index}}</td>
                <td>{{$item->patient->name_th}} {{$item->patient->lastname_th}}</td>
                <td>{{$item->patient->tel}}</td>
                <td></td>
                <td><a href="http://127.0.0.1:8000/admin/doctor/casedetail">รายละเอียดเพิ่มเติม</a></td>
            </tr>
            @endforeach
    </table>
</body>
</html>

