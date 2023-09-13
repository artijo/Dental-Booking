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
    @foreach ($patient->cases as $item)
    {{$item->case_title}} <br>
    {{$item->case_detail}} <br>
    @if($item->case_status === 1)รอเข้าพบ @elseif($item->case_status === 2)ไม่มาพบตามนัด @elseif($item->case_status === 3)เสร็จสิ้น@endif <br>
    <a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a>

    @endforeach
</body>
</html>