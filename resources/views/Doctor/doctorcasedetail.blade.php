<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    รหัสผู้ป่วย : {{$case->patient->idcard}} <br>

    ชื่อผู้ป่วย : {{$case->patient->name_th}} {{$case->patient->lastname_th}} <br>

    หัวข้อการรักษา : {{$case->case_title}} <br>
    รายละเอียดการรักษา : {{$case->case_detail}} <br>
    สถานะการรักษา : @if($case->case_status === 1)รอเข้าพบ @elseif($case->case_status === 2)ไม่มาพบตามนัด @elseif($case->case_status === 3)เสร็จสิ้น@endif <br>
    การนัด
    <table>
        <tr>
            <td>หัวข้อการนัด</td>
            <td>รายละเอียดการนัด</td>
            <td>วันที่นัด</td>
        </tr>
    
   
    @foreach ($case->bookings as $item)
    <tr>
        <td>{{$item->booking_title}}</td>
        <td>{{$item->booking_detail}}</td>
        <td>{{$item->booking_date}}</td>
    </tr>

    @endforeach
    </table>
    <a href="{{url('/admin/patient/edit/'.$case->patient->idcard)}}"><button>แก้ไข</button></a>
    <a href="{{url('/admin/case/delete/'.$case->caseid)}}"><button>ลบ</button></a>
</body>
</html>