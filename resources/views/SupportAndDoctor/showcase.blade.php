<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>showcase</title>
    <style>
        table,th,td{
            border:1px solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <button><a href="{{ route('patient.addcase')}}">เพิ่มข้อมูลการรักษา</a></button>
    <small>ประวัติการนัดหมาย</small>

  
       


    <table>
        <tr>
        <th>รายการ</th>
        <th>วันที่นัดหมาย</th>
        <th>รายละเอียด</th>
        <th>สถานะการนัด</th>
        <th>หมายเหตุ</th>
        </tr>
        @foreach($booking as $book) 
        <tr>
            <td>{{$book->booking_title}}</td>
            <td>{{date('d M Y',strtotime($book->booking_date))}}
            </td>
            <td>{{$book->booking_detail}}</td>
            <td> @if($book->case->case_status===1)
                    เสร็จสิ้น
                 @elseif($book->case->case_status===2)
                    ไม่เข้าพบตามนัด
                 @endif
                </td>
            <td><a href='#'>รายละเอียดเพิ่มเติม</a></td>
        </tr> 
       @endforeach
    </table>
</body>
</html>