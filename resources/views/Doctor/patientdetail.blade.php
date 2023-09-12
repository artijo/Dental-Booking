<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    คุุณ {{$patient->name_th}} {{$patient->lastname_th}} รหัสบัตรประชาชน {{$patient->idcard}}
    เกิดวันที่ {{$patient->birthday}} เพศ {{$patient->gender}}
    โรคประจำตัว {{$patient->intolerance}} <br>
    <h2>ประวัติการรักษา</h2>
    @foreach ($cases as $item)
    {{$item->case_title}} <br>
    {{$item->case_detail}} <br>
    {{$item->case_status}} <br>

    @endforeach
</body>
</html>